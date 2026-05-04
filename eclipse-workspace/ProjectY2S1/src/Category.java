import java.io.Serializable;

public class Category implements Serializable {
    private String name;
    private String description;

    // Constructor
    public Category(String name, String description) {
        this.name = name;
        this.description = description;
    }

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }
}
