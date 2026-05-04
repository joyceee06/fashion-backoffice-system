import java.util.Random;

import javax.swing.JOptionPane;

public class Alert {
	String[] alerts = {
		    "Oops! You missed your workout today. Let’s get back on track tomorrow! 💪",
		    "Skipping workouts won’t get you closer to your goals! Make time for it next time. 🏋️",
		    "Consistency is key! Don’t let one missed session turn into a habit. Get back at it! 🔥",
		    "Your body needs movement! Make sure to schedule your workout tomorrow. 📅",
		    "Missed a workout? No worries, just don’t make it a habit! You got this! 🚀",
		    "You forgot your meal! Your body needs fuel to stay strong. 🍽️",
		    "Skipping meals can slow you down! Make sure to eat something nutritious. 🥗",
		    "Your energy levels depend on your nutrition! Don’t miss another meal. ⚡",
		    "A healthy lifestyle is all about balance. Plan your meals better next time! 🕒",
		    "No workout, no meal? Let’s make tomorrow a fresh start! Stay on track. ✅"
		};

	Alert() {
		int randomIndex = new Random().nextInt(10);
		
		String message = String.format(
				"Date: %s%n" +
				"Alert: %s",
				GlobalMethods.generateRandomDate(), alerts[randomIndex]);
		
		JOptionPane.showMessageDialog(null, message, "Alert!", JOptionPane.WARNING_MESSAGE);
	}
}
