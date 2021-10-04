
public class DisplayMassageByte {

	

	 public static String display(byte a[]) {
	  String s = "";
	  for (int i = 0; i < a.length; i++)
	   s += Byte.toString(a[i]);
	  return s;
	 }
}
