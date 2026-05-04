import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.HashMap;

public class Login extends JFrame {
    private JTextField usernameField;
    private JPasswordField passwordField;
    private JButton loginButton, registerButton;
    private static HashMap<String, String> userDatabase = new HashMap<>();

    public Login() {
        setTitle("Login Page");
        setSize(500, 300);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLayout(new BorderLayout(10, 10));

        JPanel panel = new JPanel();
        panel.setBackground(new Color(50, 50, 100)); // Dark Blue Background
        panel.setLayout(new GridLayout(3, 2, 10, 10));

        // Create Labels
        JLabel userLabel = new JLabel("Username:");
        userLabel.setFont(new Font("Arial", Font.BOLD, 16)); // Bold Font
        userLabel.setForeground(Color.WHITE); // White Color

        JLabel passLabel = new JLabel("Password:");
        passLabel.setFont(new Font("Arial", Font.BOLD, 16)); // Bold Font
        passLabel.setForeground(Color.WHITE); // White Color

        panel.add(userLabel);
        usernameField = new JTextField();
        usernameField.setFont(new Font("Arial", Font.BOLD, 16));
        panel.add(usernameField);

        panel.add(passLabel);
        passwordField = new JPasswordField();
        passwordField.setFont(new Font("Arial", Font.BOLD, 16));
        panel.add(passwordField);

        loginButton = new JButton("Login");
        loginButton.setFont(new Font("SansSerif", Font.BOLD, 18));
        loginButton.setBackground(Color.BLUE);
        loginButton.setForeground(Color.WHITE);
        panel.add(loginButton);

        registerButton = new JButton("Register");
        registerButton.setFont(new Font("SansSerif", Font.BOLD, 18));
        registerButton.setBackground(Color.GRAY);
        registerButton.setForeground(Color.WHITE);
        panel.add(registerButton);

        add(panel, BorderLayout.CENTER);

        setLocationRelativeTo(null);
        setVisible(true);

        // Event Listeners
        loginButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String username = usernameField.getText();
                String password = new String(passwordField.getPassword());

                if (authenticateUser(username, password)) {
                    JOptionPane.showMessageDialog(null, "Login Successful!");
                    dispose();
                    new MainMenu();
                } else {
                    JOptionPane.showMessageDialog(null, "Invalid Credentials!", "Error", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        registerButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                registerUser();
            }
        });
    }

    private boolean authenticateUser(String username, String password) {
        return userDatabase.containsKey(username) && userDatabase.get(username).equals(password);
    }

    private void registerUser() {
        String username = JOptionPane.showInputDialog("Enter a username:");
        if (username == null || username.trim().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Username cannot be empty!", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        String password = JOptionPane.showInputDialog("Enter a password:");
        if (password == null || password.trim().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Password cannot be empty!", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        if (userDatabase.containsKey(username)) {
            JOptionPane.showMessageDialog(null, "Username already exists!", "Error", JOptionPane.ERROR_MESSAGE);
        } else {
            userDatabase.put(username, password);
            JOptionPane.showMessageDialog(null, "Registration Successful!");
        }
    }

    public static void main(String[] args) {
        userDatabase.put("admin", "1234");
        new Login();
    }
}
