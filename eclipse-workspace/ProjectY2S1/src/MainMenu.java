import javax.swing.*;
import java.awt.*;
import java.awt.event.*;

public class MainMenu extends JFrame {
    private JPanel mainPanel, buttonPanel;
    private JLabel titleLabel, subtitleLabel, descriptionLabel;
    private JButton workoutButton, foodButton, progressButton, reportButton, reminderButton, alertButton;

    public MainMenu() {
        setTitle("Fitness Management System");
        setSize(1920, 1080);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        getContentPane().setLayout(new BorderLayout());

        // Main Panel Styling
        mainPanel = new JPanel();
        mainPanel.setBackground(new Color(30, 30, 60));
        mainPanel.setLayout(new BoxLayout(mainPanel, BoxLayout.Y_AXIS));

        // Title Styling
        titleLabel = new JLabel("Fitness Management System");
        titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        titleLabel.setFont(new Font("SansSerif", Font.BOLD, 60));
        titleLabel.setForeground(new Color(255, 255, 255));
        titleLabel.setBorder(BorderFactory.createEmptyBorder(20, 50, 10, 50));

        subtitleLabel = new JLabel("Your Personal Fitness Dashboard");
        subtitleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        subtitleLabel.setFont(new Font("SansSerif", Font.ITALIC, 24));
        subtitleLabel.setForeground(new Color(180, 180, 250));
        subtitleLabel.setBorder(BorderFactory.createEmptyBorder(0, 50, 20, 50));

        descriptionLabel = new JLabel("Track workouts, meals, progress, and generate reports.");
        descriptionLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        descriptionLabel.setFont(new Font("SansSerif", Font.PLAIN, 18));
        descriptionLabel.setForeground(new Color(200, 200, 255));

        // Button Panel Styling
        buttonPanel = new JPanel(new GridLayout(2, 2, 20, 20));
        buttonPanel.setBackground(new Color(40, 40, 70));
        buttonPanel.setBorder(BorderFactory.createEmptyBorder(20, 50, 20, 50));

        // Button Design
        workoutButton = createStyledButton("Workout Tracking");
        foodButton = createStyledButton("Food Tracking");
        progressButton = createStyledButton("Progress Tracking");
        reportButton = createStyledButton("Monthly Report");
        reminderButton = createStyledButton("Reminder");
        alertButton = createStyledButton("Alert");

        // Button Actions
        workoutButton.addActionListener(e -> new workoutRecord());
        foodButton.addActionListener(e -> new FoodTracking());
        progressButton.addActionListener(e -> new progressTracking());
        reportButton.addActionListener(e -> new MonthlyReport());
        reminderButton.addActionListener(e -> new Reminder());
        alertButton.addActionListener(e -> new Alert());

        // Adding Buttons
        buttonPanel.add(workoutButton);
        buttonPanel.add(foodButton);
        buttonPanel.add(progressButton);
        buttonPanel.add(reportButton);
        buttonPanel.add(reminderButton);
        buttonPanel.add(alertButton);

        // Adding Components
        mainPanel.add(titleLabel);
        mainPanel.add(subtitleLabel);
        mainPanel.add(descriptionLabel);
        mainPanel.add(buttonPanel);

        getContentPane().add(mainPanel);

        setResizable(true);
        pack();
        setLocationRelativeTo(null);
        setVisible(true);
    }

    private JButton createStyledButton(String text) {
        JButton button = new JButton(text);
        button.setFont(new Font("SansSerif", Font.BOLD, 24));
        button.setBackground(new Color(85, 105, 255));
        button.setForeground(Color.WHITE);
        button.setFocusPainted(false);
        button.setBorder(BorderFactory.createEmptyBorder(15, 20, 15, 20));

        button.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseEntered(java.awt.event.MouseEvent evt) {
                button.setBackground(new Color(65, 85, 235));
            }

            public void mouseExited(java.awt.event.MouseEvent evt) {
                button.setBackground(new Color(85, 105, 255));
            }
        });
        return button;
    }

    public static void main(String[] args) {
        new MainMenu();
    }
}
