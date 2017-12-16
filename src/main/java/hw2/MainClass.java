package hw2;

import org.apache.spark.api.java.JavaSparkContext;
import org.apache.spark.sql.SQLContext;
import org.apache.spark.sql.DataFrame;

public class MainClass {

    /**
     * Function main
     * Set @param path to file in HDFS from @param args or default FILE
     * Started method run
     * */
    public static void main(String[] args) {

        String path = "hdfs://127.0.0.1:8020/";
        if(args.length==0)
            path+="user/cloudera/hw2/FlumeData.1513459338145";
        else
            path+=args[0];


        new MainClass().run(path);
    }



    /**
     * @param - path to JSON file in HDFS
     * Create Spark Content
     * Parse JSON input to DataFrame On TempTable "data"
     * Select from data
     * show() result
     * */
    public void run(String path) {
        JavaSparkContext sc = new JavaSparkContext("local[*]", "hw2");

        SQLContext sqlCtx = new SQLContext(sc);
        DataFrame input = sqlCtx.jsonFile(path);

        input.registerTempTable("data");

        DataFrame inputsql = sqlCtx.sql("SELECT age, ROUND(AVG(avgcount)) AS countavg, ROUND(AVG(avgsalary)) AS salaryavg FROM (SELECT passport, AVG(about.count) AS avgcount, AVG(about.salary) AS avgsalary, MAX(about.agevalue) AS age FROM data GROUP BY passport) newdata GROUP BY age ORDER BY age");

        inputsql.show();

    }




}

