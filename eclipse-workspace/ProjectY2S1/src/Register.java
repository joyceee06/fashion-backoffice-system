import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class Register extends JFrame {
    private JTextField usernameField;
    private JPasswordField passwordField;
    private JButton registerButton;
    private JButton backButton;

    public Register() {
        setTitle("Register Page");
        setSize(300, 200);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setLayout(new GridLayout(4, 2));

        // UI Components
        add(new JLabel("New Username:"));
        usernameField = new JTextField();
        add(usernameField);

        add(new JLabel("New Password:"));
        passwordField = new JPasswordField();
        add(passwordField);

        registerButton = new JButton("Register");
        add(registerButton);

        backButton = new JButton("Back to Login");
        add(backButton);

        // Register Button Action
        registerButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String username = usernameField.getText();
                String password = new String(passwordField.getPassword());
                if (registerUser(username, password)) {
                    JOptionPane.showMessageDialog(null, "User " + username + " registered successfully!");
                    dispose(); // Close registration window
                    new Login(); // Navigate back to the login page
                } else {
                    JOptionPane.showMessageDialog(null, "Registration failed. Please try again!", "Error", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Back Button Action
        backButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                dispose(); // Close registration window
                new Login(); // Navigate back to the login page
            }
        });

        setLocationRelativeTo(null); // Center the window
        setVisible(true);
    }

    private boolean registerUser(String username, String password) {
        // TODO: Replace this with actual registration logic (e.g., saving to a database or file)
        if (!username.isEmpty() && !password.isEmpty()) {
            return true; // Simulate successful registration
        }
        return false; // Simulate failed registration
    }
}
