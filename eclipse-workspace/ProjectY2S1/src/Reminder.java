import java.util.Random;

import javax.swing.JOptionPane;

public class Reminder {
	
	String[] reminders = {
		    "Time to move! Get your workout in and crush your fitness goals today! 💪",
		    "Stay strong, stay consistent! Don’t forget your workout today. 🏋️‍♂️",
		    "Fuel your body right! Remember to have your pre-workout meal. 🍏",
		    "Hydration check! Drink water before you start your workout. 💧",
		    "Your future self will thank you! Get that workout done now. 🔥",
		    "Healthy habits lead to a healthy life! Have your post-workout meal. 🍽️",
		    "No excuses! Even a short workout is better than none. Keep pushing! 🚀",
		    "Listen to your body—stretch before and after your workout. 🏃‍♀️",
		    "Small steps make a big difference. Keep up the consistency! ✅",
		    "Balance is key! Get your workout done and enjoy a nutritious meal. 🥗"
		};
	
	public Reminder() {
		int randomIndex = new Random().nextInt(10);
		
		String message = String.format(
				"Date: %s%n" +
				"Reminder: %s",
				GlobalMethods.generateRandomDate(), reminders[randomIndex]);
				 
		
		JOptionPane.showMessageDialog(null, message, "Reminder!", JOptionPane.INFORMATION_MESSAGE);

	}
}