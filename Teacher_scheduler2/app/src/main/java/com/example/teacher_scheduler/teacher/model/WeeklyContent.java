package com.example.teacher_scheduler.teacher.model;

public class WeeklyContent {
    private int weekNumber;
    private String content;

    public WeeklyContent(int weekNumber, String content) {
        this.weekNumber = weekNumber;
        this.content = content;
    }

    public int getWeekNumber() {
        return weekNumber;
    }

    public void setWeekNumber(int weekNumber) {
        this.weekNumber = weekNumber;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }
}
