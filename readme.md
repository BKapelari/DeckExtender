# This is a TEST! Don't use this on a productive system

### 1.) Install this: https://apps.nextcloud.com/apps/dashboardcharts

### 2.) Stop Apache

### 3.) config
edit the database-connection in the files Chart1.php, Chart2.php and Chart3.php

### 4.) override
+ Override the files Chart1.php, Chart2.php and Chart3.php in /apps/dashboardcharts/templates/widgets/
+ Override the files charts1.css in apps/dashboardcharts/css/widgets

### 5.) Start Apache, clear cache

### 6.) add the new Chart1, Chart2, and Chart3 widgets to the dashboard
