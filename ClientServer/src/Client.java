import java.util.*;
import java.util.stream.Collectors;
import java.net.*;
import java.io.*;
import java.math.*;

public class Client {
 
 public static void main(String args[]) {
	 RSA RSA=new RSA();
  List<BigInteger> i = new ArrayList<>();
  i.add(RSA.num);
  i.add(RSA.exp);
  try {
   String pub1 = i.stream().map(String::valueOf).collect(Collectors.joining(","));
   Scanner ser = new Scanner(System.in);
   Socket s = new Socket("localhost", 653);
   DataInputStream dis = new DataInputStream(s.getInputStream());
   DataOutputStream dos = new DataOutputStream(s.getOutputStream());
   System.out.println("Connected to Server");
   dos.writeUTF(pub1);
   // System.out.println(dis.readUTF());
   String pub = dis.readUTF();
   String[] arr = pub.split(",");
   BigInteger n = new BigInteger(arr[0]);
   BigInteger e = new BigInteger(arr[1]);
   // System.out.println(n);
   // System.out.println(e);
   int done = 1;
   while (done != 0) {
    System.out.println("Enter 1 to Continue Send Message or 0 to End Chat");
    done = ser.nextInt();
    if (done != 0) {
     System.out.println("\nEnter Message  ");
     ser.nextLine();
     String msg = ser.nextLine();
     byte msg_arr[] = msg.getBytes();
     byte en[] = RSA.encrypt(msg_arr, e, n);
     dos.writeInt(en.length);
     dos.write(en);
     int length = dis.readInt();

     if (length > 0) {
      byte[] enc = new byte[length];
      dis.readFully(enc, 0, enc.length);
     // System.out.println("........................\nEncrypted Byte Array : " + DisplayMassageByte.display(enc)+"........................\n");
      byte MSG[] = RSA.decrypt(enc);
      System.out.println("Received Message : " + new String(MSG));
     }
    }
   }
   dis.close();
   dos.close();
   s.close();
   ser.close();
  } catch (IOException e) {
   System.out.println("IO: " + e.getMessage());
  }
 }


}