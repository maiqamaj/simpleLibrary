import java.math.BigInteger;
import java.util.Random;

public class RSA {
	public static BigInteger p, q, exp, d, num, phi;
	public  static int bitLength = 1024;
	public  static Random R = new Random();
	 RSA (){
	 p = BigInteger.probablePrime(bitLength, R);
	  q = BigInteger.probablePrime(bitLength, R);
	  num = p.multiply(q);
	  exp = new BigInteger("65537");
	 
	  phi = p.subtract(BigInteger.ONE).multiply(q.subtract(BigInteger.ONE));
	  while (phi.gcd(exp).compareTo(BigInteger.ONE) != 0 && exp.compareTo(phi) < 0)
	   exp.add(BigInteger.ONE);
	  d = exp.modInverse(phi);
	  }
	 
	 
	 static byte[] encrypt(byte a[], BigInteger e, BigInteger n) {
		  return (new BigInteger(a).modPow(e, n)).toByteArray();
		 }

		 static byte[] decrypt(byte a[]) {
		  return (new BigInteger(a).modPow(d, num)).toByteArray();
		 }
}

