import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Date;

public class progressTracking {
    private JFrame frame;
    private JTextField weightField, chestField, waistField, hipField;
    private DefaultTableModel tableModel;
    
    public progressTracking() {
        frame = new JFrame("Health Progress Tracker");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(500, 400);
        frame.setLayout(new BorderLayout());
        
        // Input Panel
        JPanel inputPanel = new JPanel(new GridLayout(5, 2));
        inputPanel.add(new JLabel("Weight (kg):"));
        weightField = new JTextField();
        inputPanel.add(weightField);
        
        inputPanel.add(new JLabel("Chest (cm):"));
        chestField = new JTextField();
        inputPanel.add(chestField);
        
        inputPanel.add(new JLabel("Waist (cm):"));
        waistField = new JTextField();
        inputPanel.add(waistField);
        
        inputPanel.add(new JLabel("Hip (cm):"));
        hipField = new JTextField();
        inputPanel.add(hipField);
        
        JButton addButton = new JButton("Add Entry");
        JButton clearButton = new JButton("Clear Fields");
        inputPanel.add(addButton);
        inputPanel.add(clearButton);
        
        // Table Panel
        tableModel = new DefaultTableModel(new String[]{"Weight", "Chest", "Waist", "Hip"}, 0);
        JTable table = new JTable(tableModel);
        JScrollPane scrollPane = new JScrollPane(table);
        
        // Add Action Listeners
        addButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String weight = weightField.getText();
                String chest = chestField.getText();
                String waist = waistField.getText();
                String hip = hipField.getText();
                
                if (!weight.isEmpty() && !chest.isEmpty() && !waist.isEmpty() && !hip.isEmpty()) {
                    // Add to table
                    tableModel.addRow(new Object[]{weight, chest, waist, hip});
                    
                    // Save entry to text file
                    saveEntryToFile(weight, chest, waist, hip);
                    
                    // Clear the fields
                    weightField.setText("");
                    chestField.setText("");
                    waistField.setText("");
                    hipField.setText("");
                } else {
                    JOptionPane.showMessageDialog(frame, "Please fill in all fields.", "Error", JOptionPane.ERROR_MESSAGE);
                }
            }
        });
        
        clearButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                weightField.setText("");
                chestField.setText("");
                waistField.setText("");
                hipField.setText("");
            }
        });
        
        // Add Components to Frame
        frame.add(inputPanel, BorderLayout.NORTH);
        frame.add(scrollPane, BorderLayout.CENTER);
        
        frame.setVisible(true);
    }
    
    private void saveEntryToFile(String weight, String chest, String waist, String hip) {
        // Use current date in Date.toString() format.
        String dateStr = new Date().toString();
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("progress_data.txt", true))) {
            writer.write("Date: " + dateStr + "\n");
            writer.write("Weight (kg): " + weight + "\n");
            writer.write("Chest (cm): " + chest + "\n");
            writer.write("Waist (cm): " + waist + "\n");
            writer.write("Hip (cm): " + hip + "\n");
            writer.write("\n"); // Blank line between entries
        } catch (IOException ex) {
            ex.printStackTrace();
        }
    }
    
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> new progressTracking());
    }
}
