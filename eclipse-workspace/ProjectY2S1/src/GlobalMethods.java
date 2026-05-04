import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Random;
import java.util.TimeZone;

public class GlobalMethods {
	public static String generateRandomDate() {
        Random random = new Random();
        Calendar calendar = Calendar.getInstance();
        
        // Generate a random year (e.g., between 2020 and 2030)
        int year = 2025;//2020 + random.nextInt(11);

        // Generate a random month (0 = Jan, 11 = Dec)
        int month = random.nextInt(12);

        // Set the calendar to the first day of the month
        calendar.set(Calendar.YEAR, year);
        calendar.set(Calendar.MONTH, month);
        calendar.set(Calendar.DAY_OF_MONTH, 1);
        
        // Get the max days in that month/year and set a random day
        int maxDay = calendar.getActualMaximum(Calendar.DAY_OF_MONTH);
        int day = 1 + random.nextInt(maxDay);
        calendar.set(Calendar.DAY_OF_MONTH, day);

        // Generate random hour, minute, and second
        int hour = random.nextInt(24);
        int minute = random.nextInt(60);
        int second = random.nextInt(60);
        calendar.set(Calendar.HOUR_OF_DAY, hour);
        calendar.set(Calendar.MINUTE, minute);
        calendar.set(Calendar.SECOND, second);

        // Set a specific timezone (e.g., MYT - Malaysia Time)
        calendar.setTimeZone(TimeZone.getTimeZone("Asia/Kuala_Lumpur"));

        // Format the date
        SimpleDateFormat dateFormat = new SimpleDateFormat("EEE MMM dd HH:mm:ss z yyyy");
        dateFormat.setTimeZone(calendar.getTimeZone());

        return dateFormat.format(calendar.getTime());
    }
}
