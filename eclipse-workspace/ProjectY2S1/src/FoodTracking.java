import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.HashMap;
import java.util.Date;
import javax.swing.SpinnerDateModel;
import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;

public class FoodTracking extends JFrame {
    private JPanel mainPanel, inputPanel, buttonPanel;
    private JLabel titleLabel, subtitleLabel, descriptionLabel;
    private JLabel dateLabel, foodLabel, totalCalorieLabel, unitLabel, quantityLabel;
    private JSpinner dateSpinner;
    private JTextField foodField, quantityField;
    private JButton calculateButton, resetButton, saveButton;

    private HashMap<String, Integer> foodCalories;

    public FoodTracking() {
        setTitle("Food Tracking System");
        setSize(1920, 1080);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        getContentPane().setLayout(new BorderLayout());

        // Initialize food calorie data
        initializeFoodCalories();

        // Main Panel Styling
        mainPanel = new JPanel();
        mainPanel.setBackground(new Color(30, 30, 60));
        mainPanel.setLayout(new BoxLayout(mainPanel, BoxLayout.Y_AXIS));

        // Title Styling
        titleLabel = new JLabel("Food Tracking System");
        titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        titleLabel.setFont(new Font("SansSerif", Font.BOLD, 60));
        titleLabel.setForeground(new Color(255, 255, 255));
        titleLabel.setBorder(BorderFactory.createEmptyBorder(20, 50, 10, 50));

        subtitleLabel = new JLabel("Track Your Daily Food Intake");
        subtitleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        subtitleLabel.setFont(new Font("SansSerif", Font.ITALIC, 24));
        subtitleLabel.setForeground(new Color(180, 180, 250));
        subtitleLabel.setBorder(BorderFactory.createEmptyBorder(0, 50, 20, 50));

        descriptionLabel = new JLabel("Enter your food details to calculate total calories.");
        descriptionLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        descriptionLabel.setFont(new Font("SansSerif", Font.PLAIN, 18));
        descriptionLabel.setForeground(new Color(200, 200, 255));

        // Unit Information
        unitLabel = new JLabel("* Note: Calories are calculated per 100g or 100ml as applicable.");
        unitLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        unitLabel.setFont(new Font("SansSerif", Font.PLAIN, 16));
        unitLabel.setForeground(new Color(220, 220, 255));
        unitLabel.setBorder(BorderFactory.createEmptyBorder(5, 50, 10, 50));

        // Input Panel Styling
        inputPanel = new JPanel(new GridLayout(4, 2, 20, 20));
        inputPanel.setBackground(new Color(40, 40, 70));
        inputPanel.setBorder(BorderFactory.createEmptyBorder(20, 50, 20, 50));

        // Input Fields and Labels
        dateLabel = createStyledLabel("Date:");
        foodLabel = createStyledLabel("Food:");
        quantityLabel = createStyledLabel("Quantity (units, 1 unit = 100g/100ml):");
        totalCalorieLabel = createStyledLabel("Total Calories from Food:");

        dateSpinner = new JSpinner(new SpinnerDateModel());
        dateSpinner.setEditor(new JSpinner.DateEditor(dateSpinner, "dd/MM/yyyy"));
        dateSpinner.setValue(new Date());

        foodField = createStyledTextField();
        quantityField = createStyledTextField();

        // Adding Input Components
        inputPanel.add(dateLabel);
        inputPanel.add(dateSpinner);
        inputPanel.add(foodLabel);
        inputPanel.add(foodField);
        inputPanel.add(quantityLabel);
        inputPanel.add(quantityField);
        inputPanel.add(totalCalorieLabel);
        inputPanel.add(new JLabel()); // Placeholder for alignment

        // Button Panel Styling
        buttonPanel = new JPanel(new FlowLayout());
        buttonPanel.setBackground(new Color(30, 30, 60));

        // Buttons
        calculateButton = createStyledButton("Calculate");
        resetButton = createStyledButton("Reset");
        saveButton = createStyledButton("Save");

        // Button Actions
        calculateButton.addActionListener(e -> calculateCalories());
        resetButton.addActionListener(e -> resetFields());
        saveButton.addActionListener(e -> saveData());

        // Adding Buttons
        buttonPanel.add(calculateButton);
        buttonPanel.add(resetButton);
        buttonPanel.add(saveButton);

        // Adding Components
        mainPanel.add(titleLabel);
        mainPanel.add(subtitleLabel);
        mainPanel.add(descriptionLabel);
        mainPanel.add(unitLabel);
        mainPanel.add(inputPanel);
        mainPanel.add(buttonPanel);

        getContentPane().add(mainPanel);

        setResizable(true);
        pack();
        setLocationRelativeTo(null);
        setVisible(true);
    }

    private void initializeFoodCalories() {
        foodCalories = new HashMap<>();
        foodCalories.put("Apple", 52); // Calories per 100g
        foodCalories.put("Banana", 89);
        foodCalories.put("Chicken Breast", 165);
        foodCalories.put("Rice", 130);
        foodCalories.put("Egg", 155);
        foodCalories.put("Milk", 42); // Per 100ml
        foodCalories.put("Bread", 265);
        foodCalories.put("Cheese", 402);
    }

    private JLabel createStyledLabel(String text) {
        JLabel label = new JLabel(text);
        label.setFont(new Font("SansSerif", Font.PLAIN, 24));
        label.setForeground(new Color(200, 200, 255));
        return label;
    }

    private JTextField createStyledTextField() {
        JTextField textField = new JTextField();
        textField.setFont(new Font("SansSerif", Font.PLAIN, 24));
        textField.setBackground(new Color(50, 50, 80));
        textField.setForeground(Color.WHITE);
        textField.setCaretColor(Color.WHITE);
        textField.setBorder(BorderFactory.createEmptyBorder(10, 20, 10, 20));
        return textField;
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

    // Updated calculation: quantity represents the number of 100g/100ml units.
    private void calculateCalories() {
        String foodName = foodField.getText().trim();
        String quantityText = quantityField.getText().trim();

        if (foodCalories.containsKey(foodName)) {
            try {
                int quantity = Integer.parseInt(quantityText);
                int baseCalories = foodCalories.get(foodName);
                double totalCalories = baseCalories * quantity;
                // Use HTML formatting to ensure the full text is displayed
                totalCalorieLabel.setText("<html>Total Calories from Food: " + totalCalories + " kCal</html>");
            } catch (NumberFormatException e) {
                JOptionPane.showMessageDialog(this, "Please enter a valid quantity.", "Input Error", JOptionPane.ERROR_MESSAGE);
            }
        } else {
            JOptionPane.showMessageDialog(this, "Food not found in database. Please try another food.", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }

    private void resetFields() {
        dateSpinner.setValue(new Date());
        foodField.setText("");
        quantityField.setText("");
        totalCalorieLabel.setText("Total Calories from Food:");
    }

    // Save data with the date using Date.toString() format.
    private void saveData() {
        Date date = (Date) dateSpinner.getValue();
        String foodName = foodField.getText();
        String quantity = quantityField.getText();
        
        // Remove HTML tags and extract only the calorie value with "kCal"
        String rawText = totalCalorieLabel.getText().replaceAll("<[^>]*>", "");
        String prefix = "Total Calories from Food:";
        String totalCalories = rawText;
        if (rawText.startsWith(prefix)) {
            totalCalories = rawText.substring(prefix.length()).trim();
        }
        
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("food_data.txt", true))) {
            writer.write("Date: " + date.toString() + "\n");
            writer.write("Food: " + foodName + "\n");
            writer.write("Quantity: " + quantity + " units\n");
            writer.write("Total Calories: " + totalCalories + "\n");
            writer.write("\n"); // Add a new line after each food entry
        } catch (IOException e) {
            e.printStackTrace();
        }

        JOptionPane.showMessageDialog(this, "Data Saved:\n" +
                "Date: " + date.toString() + "\n" +
                "Food: " + foodName + "\n" +
                "Quantity: " + quantity + " units\n" +
                "Total Calories: " + totalCalories, "Data Saved", JOptionPane.INFORMATION_MESSAGE);
    }

    public static void main(String[] args) {
        new FoodTracking();
    }
}
