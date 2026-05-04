import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.Date;
import javax.swing.SpinnerDateModel;
import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;

public class workoutRecord extends JFrame {
    private Workout workout;
    private Calories calories;
    private JSplitPane splitPane;
    private JPanel inputPanel, formPanel;
    private JLabel titleLabel;
    private JTextField nameField, durationField, caloriesField;
    private JComboBox<String> categoryComboBox;
    private JSpinner dateSpinner;
    private JButton addButton;
    private JTextArea displayArea;
    private JScrollPane scrollPane;

    public workoutRecord() {
        setTitle("Workout Record");
        setSize(600, 300);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setLocationRelativeTo(null);

        workout = new Workout(new Date());
        calories = new Calories(new Date());

        splitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT);
        splitPane.setDividerLocation(150);
        splitPane.setDividerSize(5);

        //Workout Summary
        displayArea = new JTextArea();
        displayArea.setFont(new Font("Berlin Sans FB", Font.PLAIN, 12));
        displayArea.setEditable(false);
        displayArea.setBackground(new Color(240, 248, 255));
        displayArea.setBorder(BorderFactory.createTitledBorder("Workout Summary"));

        scrollPane = new JScrollPane(displayArea);
        scrollPane.setPreferredSize(new Dimension(150, 0));

        inputPanel = new JPanel(new BorderLayout(10, 10));
        inputPanel.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
        inputPanel.setBackground(new Color(64, 0, 128));

        //Title
        titleLabel = new JLabel("Workout Record", JLabel.CENTER);
        titleLabel.setFont(new Font("Berlin Sans FB", Font.BOLD, 28));
        titleLabel.setForeground(Color.WHITE);
        inputPanel.add(titleLabel, BorderLayout.NORTH);

        formPanel = new JPanel(new GridLayout(5, 2, 10, 10));
        formPanel.setBackground(new Color(64, 0, 128));

        //Date
        formPanel.add(createLabel("Date:"));
        dateSpinner = new JSpinner(new SpinnerDateModel());
        dateSpinner.setEditor(new JSpinner.DateEditor(dateSpinner, "dd/MM/yyyy"));
        dateSpinner.setValue(new Date());
        formPanel.add(dateSpinner);
        
        //Workout Name
        formPanel.add(createLabel("Workout Name:"));
        nameField = new JTextField(10);
        formPanel.add(nameField);
        
        //Workout Category
        formPanel.add(createLabel("Category:"));
        categoryComboBox = new JComboBox<>(new String[]{"Aerobic", "Anaerobic", "Strength Training"});
        categoryComboBox.setBackground(new Color(255, 255, 255));
        categoryComboBox.setFont(new Font("Berlin Sans FB", Font.PLAIN, 14));
        formPanel.add(categoryComboBox);
        
        //Duration
        formPanel.add(createLabel("Duration (min):"));
        durationField = new JTextField(5);
        formPanel.add(durationField);
        
        //Calories Burned
        formPanel.add(createLabel("Calories Burned (kCal):"));
        caloriesField = new JTextField(5);
        formPanel.add(caloriesField);

        //Button for record exercise
        addButton = new JButton("Record Exercise");
        addButton.setBackground(new Color(104, 0, 208));
        addButton.setForeground(Color.WHITE);
        addButton.setFont(new Font("Berlin Sans FB Demi", Font.BOLD, 14));

        addButton.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseEntered(java.awt.event.MouseEvent evt) {
                addButton.setBackground(new Color(85, 0, 170));
            }

            public void mouseExited(java.awt.event.MouseEvent evt) {
                addButton.setBackground(new Color(104, 0, 208));
            }
        });

        addButton.addActionListener(e -> {
            String name = nameField.getText();
            String categoryName = (String) categoryComboBox.getSelectedItem();
            int duration = Integer.parseInt(durationField.getText());
            int cal = Integer.parseInt(caloriesField.getText());
            Date selectedDate = (Date) dateSpinner.getValue();

            Exercise exercise = new Exercise(name, duration, cal, new Category(categoryName, ""), selectedDate);
            workout.addExercise(exercise);
            calories.addExercise(exercise);

            saveWorkoutDataToFile(exercise);
            displayWorkoutSummary();

            nameField.setText("");
            durationField.setText("");
            caloriesField.setText("");
        });

        inputPanel.add(formPanel, BorderLayout.CENTER);
        inputPanel.add(addButton, BorderLayout.SOUTH);

        splitPane.setLeftComponent(scrollPane);
        splitPane.setRightComponent(inputPanel);

        getContentPane().add(splitPane);
        setVisible(true);
    }

    private JLabel createLabel(String text) {
        JLabel label = new JLabel(text);
        label.setForeground(Color.WHITE);
        label.setFont(new Font("Berlin Sans FB", Font.PLAIN, 14));
        return label;
    }

    private void displayWorkoutSummary() {
        StringBuilder summary = new StringBuilder();
        for (Exercise e : workout.getExercises()) {
            summary.append("Workout: ").append(e.getName())
                   .append("\nCategory: ").append(e.getCategory().getName())
                   .append("\nDuration: ").append(e.getDuration())
                   .append(" mins\nCalories: ").append(e.getCalories())
                   .append(" kCal\nDate: ").append(e.getDate())
                   .append("\n\n");
        }
        summary.append("\nTotal Duration: ").append(workout.getTotalDuration()).append(" mins");
        summary.append("\nTotal Calories: ").append(calories.getTotalCalories()).append(" kCal");
        displayArea.setText(summary.toString());
    }

    private void saveWorkoutDataToFile(Exercise exercise) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("workout_data.txt", true))) {
            writer.write("Date: " + exercise.getDate() + "\n");
            writer.write("Workout: " + exercise.getName() + "\n");
            writer.write("Category: " + exercise.getCategory().getName() + "\n");
            writer.write("Duration: " + exercise.getDuration() + " mins\n");
            writer.write("Calories: " + exercise.getCalories() + " kCal\n");
            writer.write("\n"); 
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}
