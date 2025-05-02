🔹 Run Laravel Scheduler Every Minute:

sh
Copy
Edit


command
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

👆 Ye command Laravel ke scheduler ko har minute execute karegi, aur jab dailyAt('00:00') wala schedule match hoga, tab TaskDueReminder run hoga.

🛠 Cron Job Setup ka Process:

Server par terminal khol lo (SSH ya CPanel).
crontab -e open karo.
Upar wali command add kar do.
Save aur exit kar lo.
