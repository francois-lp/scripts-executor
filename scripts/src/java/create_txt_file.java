import java.io.FileWriter;
import java.io.IOException;
import java.util.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

public class WriteToFile {
  public static void main(String[] args) {
    try {
      // file path
      DateFormat formatter = new SimpleDateFormat("yyyyMMdd_HHmmss");
      String strCurrentDateTime = formatter.format(new Date());
      // TODO : get directories from the command line options (like the PHP script)
      String filePath = "scripts\\output\\java\\" + strCurrentDateTime + "_generated_by_java_script.txt";

      // file writing
      FileWriter myWriter = new FileWriter(filePath);
      myWriter.write("Java script executed from PHP");
      myWriter.close();  
      
      System.out.println("Java script executed successfully !");
    } catch (IOException e) {
      System.out.println("Error : " + e.getMessage());
      e.printStackTrace();
    }
  }
}
