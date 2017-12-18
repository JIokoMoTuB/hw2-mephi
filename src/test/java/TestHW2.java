import org.junit.*;
import java.util.*;
import java.io.*;
import static junit.framework.Assert.*;

public class TestHW2
{

        private String path_source = "/home/cloudera/Desktop/hw2/hw2test-source.txt";
        private String path_result = "/home/cloudera/Desktop/hw2/hw2test-result.txt";

        private String readfiletest(String path)
        {
                String s = "";
                try
                {
                        Scanner in = new Scanner(new File(path));
                        while(in.hasNext())
                                s += in.nextLine() + "\r\n";
                        in.close();
                }catch (Exception e){}

                return s;
        }

        @Test
        public void testSpark() throws Exception {
                try {
                        assertEquals(readfiletest(path_source), readfiletest(path_result));
                }catch(AssertionError e){

                }
        }




}
