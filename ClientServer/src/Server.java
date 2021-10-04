import java.util.*;
import java.util.stream.Collectors;
import java.net.*;
import java.io.*;
import java.math.*;

public class Server {
 

 public static void main(String args[]) {
 RSA RSA=new RSA();
  List<BigInteger> i = new ArrayList<>();
  i.add(RSA.num);
  i.add(RSA.exp);
  try {
   String pub = i.stream().map(String::valueOf).collect(Collectors.joining(","));
   Scanner scr = new Scanner(System.in);
   ServerSocket s = new ServerSocket(653);
   System.out.println("Server ready \n*******waiting for connection******* \n");
   Socket s1 = s.accept();
   DataOutputStream dos = new DataOutputStream(s1.getOutputStream());
   DataInputStream dis = new DataInputStream(s1.getInputStream());
   System.out.println("Connected to 127.0.0.1");
   dos.writeUTF(pub);
   String pub1 = dis.readUTF();
   String[] arr = pub1.split(",");
   BigInteger num = new BigInteger(arr[0]);
 
   BigInteger exp = new BigInteger(arr[1]);

   int done = 1;
   while (done != 0) {
    int length = dis.readInt();
    if (length > 0) {
     byte[] en = new byte[length];
     dis.readFully(en, 0, en.length);
     //System.out.println("........................\nEncrypted Byte Array : " + DisplayMassageByte.display(en)+"........................\n");
     byte MSG[] = RSA.decrypt(en);
     System.out.println("Received Message : " + new String(MSG));
    }
    System.out.println("Enter 1 to Continue Send Message or 0 to End Chat");
    done = scr.nextInt();
    if (done != 0) {
     System.out.println("Enter Message");
     scr.nextLine();
     String msg = scr.nextLine();
     byte msg_arr[] = msg.getBytes();
     byte en[] = RSA.encrypt(msg_arr, exp, num);
     dos.writeInt(en.length);
     dos.write(en);
    }
   }
   dos.close();
   s1.close();
   scr.close();
   s.close();

  } catch (IOException e) {
   System.out.println("IO: " + e.getMessage());
  } finally {
   System.out.println("\n connection terminated");
  }
 }



}