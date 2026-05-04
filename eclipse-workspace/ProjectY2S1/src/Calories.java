import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Calories {
    private Date date;
    private int calories;
    private List<Exercise> exercises;

    public Calories(Date date) {
        this.date = date;
        this.exercises = new ArrayList<>();
    }

    public void addExercise(Exercise exercise) {
        exercises.add(exercise);
        calories += exercise.getCalories();
    }

    public int getTotalCalories() {
        return calories;
    }

    public List<Exercise> getExercises() {
        return exercises;
    }

}
