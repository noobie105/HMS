import pyDes

# class that provides encryption and decryption
class DESCrypto:
    # constructor for DESCrypto object
    def __init__(self):
        # define the 8 bit DES key, same key for every object
        self.__key = "87564312"
        # initiate pyDes object to encrypt and decrypt using DES
        self.__des = pyDes.des(self.__key,  pyDes.CBC, "\0\0\0\0\0\0\0\0", pad=None, padmode=pyDes.PAD_PKCS5)
    # method to encrypt a message
    def encrypt(self, msg):
        data = self.__des.encrypt(msg)
        # return the encrypted value
        return data
    # method to decrypt a message
    def decrypt(self, msg):
        data = self.__des.decrypt(msg)
        # return the decrypted message
        return data