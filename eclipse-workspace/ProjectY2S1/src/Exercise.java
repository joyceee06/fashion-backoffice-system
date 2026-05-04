import java.io.Serializable;
import java.util.Date;

public class Exercise implements Serializable {
 
	private static final long serialVersionUID = 1L;
	private String name;
    private int duration; 
    private int calories; 
    private Category category;
    private Date date;

    // Constructor
    public Exercise(String name, int duration, int calories, Category category, Date date) {
        this.name = name;
        this.duration = duration;
        this.calories = calories;
        this.category = category;
        this.date = date;
    }

    public String getName() {
        return name;
    }

    public int getDuration() {
        return duration;
    }

    public int getCalories() {
        return calories;
    }

    public Category getCategory() {
        return category;
    }

    public Date getDate() {
        return date;
    }
}
