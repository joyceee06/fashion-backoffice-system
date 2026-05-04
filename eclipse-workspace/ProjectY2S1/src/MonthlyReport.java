import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.*;

public class MonthlyReport extends JFrame {
    private JButton generateButton;
    private JPanel mainPanel;
    private JTextArea reportArea;
    private JComboBox<String> monthComboBox;

    public MonthlyReport() {
        setTitle("Monthly Report");
        setSize(800, 600);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setLayout(new BorderLayout());
        setLocationRelativeTo(null);

        mainPanel = new JPanel(new BorderLayout());
        mainPanel.setBackground(new Color(30, 30, 60));

        JLabel titleLabel = new JLabel("Generated Monthly Report", SwingConstants.CENTER);
        titleLabel.setFont(new Font("SansSerif", Font.BOLD, 30));
        titleLabel.setForeground(Color.WHITE);
        mainPanel.add(titleLabel, BorderLayout.NORTH);

        String[] months = {"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"};
        monthComboBox = new JComboBox<>(months);
        monthComboBox.setFont(new Font("SansSerif", Font.PLAIN, 18));
        monthComboBox.setBackground(new Color(240, 248, 255));
        monthComboBox.setSelectedIndex(1);

        JPanel comboPanel = new JPanel(new FlowLayout(FlowLayout.RIGHT));
        comboPanel.setBackground(new Color(30, 30, 60));
        comboPanel.add(monthComboBox);
        mainPanel.add(comboPanel, BorderLayout.NORTH);

        generateButton = new JButton("Generate Report");
        generateButton.setFont(new Font("SansSerif", Font.BOLD, 24));
        generateButton.setBackground(new Color(85, 105, 255));
        generateButton.setForeground(Color.WHITE);

        generateButton.addActionListener(e -> generateMonthlyReport());

        JPanel buttonPanel = new JPanel();
        buttonPanel.setBackground(new Color(30, 30, 60));
        buttonPanel.add(generateButton);
        mainPanel.add(buttonPanel, BorderLayout.SOUTH);

        reportArea = new JTextArea();
        reportArea.setEditable(false);
        reportArea.setFont(new Font("Arial", Font.PLAIN, 16));
        reportArea.setBackground(new Color(240, 248, 255));

        JScrollPane scrollPane = new JScrollPane(reportArea);
        mainPanel.add(scrollPane, BorderLayout.CENTER);

        getContentPane().add(mainPanel);
        setVisible(true);
    }

    class WorkoutEntry {
        Date date;
        String workoutDetails;

        public WorkoutEntry(Date date, String workoutDetails) {
            this.date = date;
            this.workoutDetails = workoutDetails;
        }
    }

    public void generateMonthlyReport() {
        StringBuilder reportContent = new StringBuilder();
        String selectedMonth = (String) monthComboBox.getSelectedItem();
        SimpleDateFormat dateFormat = new SimpleDateFormat("d MMMM yyyy (EEEE)");
        SimpleDateFormat monthFormat = new SimpleDateFormat("MMMM");
        SimpleDateFormat dayFormat = new SimpleDateFormat("yyyy-MM-dd");

        ArrayList<WorkoutEntry> workoutList = new ArrayList<>();

        try (BufferedReader reader = new BufferedReader(new FileReader("workout_data.txt"))) {
            String line;
            Date currentDate = null;
            StringBuilder workoutDetails = new StringBuilder();

            while ((line = reader.readLine()) != null) {
                if (line.startsWith("Date:")) {
                    String dateString = line.substring(6);
                    SimpleDateFormat originalDateFormat = new SimpleDateFormat("EEE MMM dd HH:mm:ss zzz yyyy");
                    Date date = originalDateFormat.parse(dateString);

                    if (monthFormat.format(date).equals(selectedMonth)) {
                        if (currentDate != null && workoutDetails.length() > 0) {
                            workoutList.add(new WorkoutEntry(currentDate, workoutDetails.toString().trim()));
                        }
                        currentDate = date;
                        workoutDetails = new StringBuilder();
                    }
                } else if (!line.trim().isEmpty()) {
                    workoutDetails.append(line).append(" ");
                }
            }
            if (currentDate != null && workoutDetails.length() > 0) {
                workoutList.add(new WorkoutEntry(currentDate, workoutDetails.toString().trim()));
            }
        } catch (IOException | java.text.ParseException e) {
            e.printStackTrace();
        }

        Map<String, ArrayList<String>> groupedWorkouts = new LinkedHashMap<>();

        for (WorkoutEntry entry : workoutList) {
            String dateKey = dateFormat.format(entry.date);
            groupedWorkouts.computeIfAbsent(dateKey, k -> new ArrayList<>()).add(entry.workoutDetails);
        }

        if (!groupedWorkouts.isEmpty()) {
            reportContent.append("Workouts in ").append(selectedMonth).append(":\n");
            for (Map.Entry<String, ArrayList<String>> entry : groupedWorkouts.entrySet()) {
                reportContent.append("\n").append(entry.getKey()).append(":\n");
                for (String workout : entry.getValue()) {
                    reportContent.append("    - ").append(workout).append("\n");
                }
            }
        } else {
            reportContent.append("No workouts found for the selected month.\n");
        }

        reportArea.setText(reportContent.toString());
    }

    public static void main(String[] args) {
        new MonthlyReport();
    }
}