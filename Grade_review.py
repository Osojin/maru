# -*- coding: utf-8 -*-
"""
Created on Thu May 24 11:15:44 2018

@author: jbk48
"""

import os
import tensorflow as tf
import Bi_LSTM
import Word2Vec
import gensim
import numpy as np
import sys
import io
import pymysql

W2V = Word2Vec.Word2Vec()

Batch_size = 1
Vector_size = 300
Maxseq_length = 95   ## Max length of training data
learning_rate = 0.001
lstm_units = 128
num_class = 2
keep_prob = 1.0

X = tf.placeholder(tf.float32, shape = [None, Maxseq_length, Vector_size], name = 'X')
Y = tf.placeholder(tf.float32, shape = [None, num_class], name = 'Y')
seq_len = tf.placeholder(tf.int32, shape = [None])

BiLSTM = Bi_LSTM.Bi_LSTM(lstm_units, num_class, keep_prob)

with tf.variable_scope("loss", reuse = tf.AUTO_REUSE):
    logits = BiLSTM.logits(X, BiLSTM.W, BiLSTM.b, seq_len)
    loss, optimizer = BiLSTM.model_build(logits, Y, learning_rate)

prediction = tf.nn.softmax(logits)

def Convert2Vec(model_name, sentence):

    word_vec = []
    sub = []
    model = gensim.models.word2vec.Word2Vec.load(model_name)
    for word in sentence:
        if(word in model.wv.vocab):
            sub.append(model.wv[word])
        else:
            sub.append(np.random.uniform(-0.25,0.25,300)) ## used for OOV words
    word_vec.append(sub)
    return word_vec


conn=pymysql.connect(host='localhost:3307', user='root', password='1234', db='maru')
curs=conn.cursor()

saver = tf.train.Saver()
init = tf.global_variables_initializer()
modelName = "C:\\Users\\dhdqu\\Desktop\\Bidirectional_LSTM\\BiLSTM_model.ckpt"

sess = tf.Session()
sess.run(init)
saver.restore(sess, modelName)

os.chdir("..")    
def Grade(sentence):

    tokens = W2V.tokenize(sentence)
    
    embedding = Convert2Vec('C:\\Users\\dhdqu\\Desktop\\test\\Word2vec.model', tokens)
    zero_pad = W2V.Zero_padding(embedding, Batch_size, Maxseq_length, Vector_size)
    zero_pad = W2V.Zero_padding(embedding, Batch_size, Maxseq_length, Vector_size)
    global sess
    result =  sess.run(tf.argmax(prediction,1), feed_dict = {X: zero_pad , seq_len: [len(tokens)] } ) 
    if(result == 1):
        return 1
    else:
        return -1



while(1):
    sql="select *from blog_comm where sentiment=0;"
    curs.execute(sql)
    conn.commit()
    datas=curs.fetchall()
    for data in datas:
        if(len(data[1])<95):
            sql="update blog_comm set sentiment = "+str(Grade(data[1]))+" where id = "+str(data[0])+";"
            curs.execute(sql)
            conn.commit()
            print(data[1]+" "+ str(data[0]))
       