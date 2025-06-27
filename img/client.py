import socket
from threading import Thread
from helper import DESCrypto



# define client class
class Client:
    # constructor for client class, it requires a host address and port number to connect to
    def __init__(self, host, port):
        # create an object of DES encryption and decryption helper
        self.des = DESCrypto()
        # format for encypting and decrypting messages
        self.format = "utf-8"
        self.host = host
        self.port = port
        self.name = input("Enter your name:")
        # create a socket object
        self.server = socket.socket()
        # connect the socket to desired address
        self.server.connect((self.host, self.port))
    # method that is used to send and receive incoming messages from server and show them
    def chat(self):
        # make a thread that listens for messages to this client & print them
        t = Thread(target=self.receive)
        # make the thread daemon so it ends whenever the main thread ends
        t.daemon = True
        # start the thread
        t.start()
        # take messages as input from user. typing quit will break the later loop
        message = input("Enter message to send to server: (type \'quit\' to end the conversation)")
        # take messages and send to server
        while message != "quit":
            # add name to the begining of the message
            message = self.name + ": " + message
            # encrypt the message 
            message = self.des.encrypt(message)
            # send the message to connected server
            try:
                self.server.send(message)
            except Exception as e:
                print ("Server disconnected")
                return True
            # take next message as input
            message = input()
        # after getting quit as input close the connection (terminate the conversation)
        self.server.close()
        self.close()
    # method to receive messages
    def receive(self):
        # continue receiving while this client is active 
        while True:
            try:
                # receive the message from server
                message = self.server.recv(1024)
                # decrypt the message
                message = self.des.decrypt(message).decode(self.format)
                # if a message found, show it
                if message:
                    print(message)
            except Exception as e:
                return True
    # method to close the server
    def close(self):
        # close the server
        self.server.close()
        # exit the program
        exit()

# get a host name as input
host = input("Enter host name:")
# get port number as input
port = int(input("Enter port name:"))
# create a new client object
client = Client(host, port)
# start chatting for the client
client.chat()