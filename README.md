# hw2-mephi

Запуск генератора исходных данных php -f generator-with-result.php
Выход:  данные для Spark - datatoflume.json
        данные для сравнения результатов Spark и эталонным результатом hw2test-source.txt

Запуск Flume агента sudo ./flume-tail.sh
После завершения загрузки файла - скопировать название или путь до до сгенерированного файла.

Сборка работы - mvn clean package
Запуска java -jar "jarname.jar" "filenameinhdfs"

Сохранить результат работы Spark из консоли в файл hw2test-result.txt и запустить тест.
