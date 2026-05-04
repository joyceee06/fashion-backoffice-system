import java.io.Serializable;
import java.util.Date;
import java.util.ArrayList;
import java.util.List;

public class Workout implements Serializable {
    private Date date;
    private List<Exercise> exercises;

    // Constructor
    public Workout(Date date) {
        this.date = date;
        this.exercises = new ArrayList<>();
    }

    // Getter for the date
    public Date getDate() {
        return date;
    }

    // Add an exercise to the workout
    public void addExercise(Exercise exercise) {
        exercises.add(exercise);
    }

    // Get the list of exercises for this workout
    public List<Exercise> getExercises() {
        return exercises;
    }

    // Get the total duration of the workout
    public int getTotalDuration() {
        int totalDuration = 0;
        for (Exercise e : exercises) {
            totalDuration += e.getDuration();
        }
        return totalDuration;
    }

    // Get the total calories burned during the workout
    public int getTotalCalories() {
        int totalCalories = 0;
        for (Exercise e : exercises) {
            totalCalories += e.getCalories();
        }
        return totalCalories;
    }
}
