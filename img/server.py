import socket
from threading import Thread
from helper import DESCrypto




# define server class
class Server:
    # constructor for server class, will be executed when a Server object is created
    def __init__(self, port = 5005):
        # create an object of DES encryption and decryption helper
        self.des = DESCrypto()
        # format for encypting and decrypting messages
        self.format = "utf-8"
        # get current host address, where the server will run
        self.host = socket.gethostbyname(socket.gethostname())
        # port number to interact with the server
        self.port = port
        # define address as a tuple of host address and port
        self.address = (self.host, self.port)
        # initialize the server object
        self.server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        # bind server to desired address
        self.server.bind(self.address)
        # array to store all the clients info that are connected to the port (i.e., chat conversation)
        self.client_sockets = set()
    # method to start the server
    def start(self):
        # make the server listen to incoming messages
        self.server.listen()
        # a message that describes the connection details
        print("Connect from client using host= "+ str(self.host) + " and port = " + str(self.port))
        # make the server always listen to an incoming client request
        while True:
            try:
                # get the client socket and client address when a new connection comes to server
                (client_socket, client_address) = self.server.accept()
                # add the client to all client list if it is not already connected to server
                if client_socket not in self.client_sockets:
                    self.client_sockets.add(client_socket)
                    # start a new thread that listens for each client's messages
                    t = Thread(target=self.chat, args=(client_socket, client_address))
                    # make the thread daemon so it ends whenever the main thread ends
                    t.daemon = True
                    # start the thread
                    t.start()
            # if the server is close, stop the thread
            except Exception as e:
                return True
    # method to end all client connection and close the server
    def close(self):
        # close client sockets
        toclose = []
        i=0
        for cs in self.client_sockets:
            toclose.append(cs)
            i += 1
        for cl in range(i):
            toclose[cl].close()
        
        # close server socket
        self.server.close()
    
    # method to process an incoming message from any client
    # and send it to all the clients that are connected
    # this method works parallely (using thread) for each clients 
    def chat(self, client:socket, address):
        # always check for a new incoming message
        while True:
            # try to receive a message 
            try:
                msg = client.recv(1024)
                # decrypt the message
                msg = self.des.decrypt(msg).decode(self.format)
            #connection is closed then stop the thread
            except ConnectionResetError:
                return True
            except ConnectionAbortedError:
                return True
            except Exception as e:
                # failed try means the client is not available. 
                # close the connection and remove from connected list
                self.client_sockets.remove(client)
                client.close()
                # break the while loop to stop this thread
                break
            else:
                # empty message means the client not available, remove it
                if not msg: 
                    self.client_sockets.remove(client)
                    client.close()
                    break
                # print the message to keep as server log
                print(str(address) + ":" + msg)
                # encrypt the message to every clients connected to this conversation
                reply = self.des.encrypt(msg)
                for cl in self.client_sockets:
                    cl.send(reply)

# array that stores all the server that are currently running
servers = set()
# method to start a server
def startserver():
    # get a port number as input
    port = int(input("Enter a port number for server:"))
    # create a server a desired port
    server = Server(port)
    # add newly created server to the servers list
    servers.add(server)
    # run the server in parallel via thread
    th = Thread(target=server.start)
    th.start()

# method to close all servers
def endserver():
    for server in servers:
        server.close()

# take input from user to perform an operation 
while True:
    choice = int(input('1. Start server\n2. Close all server\n3. Quit\n'))
    if choice == 1:
        try:
            startserver()
        except Exception as e:
            print(f"Failed to start: {e}")
    elif choice == 2:
        endserver()
    elif choice == 3:
        endserver()
        exit()
    else:
        print('Invalid choice')