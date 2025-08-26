package com.example.teacher_scheduler.Student.model;



public class ScheduleItem {
    private String date;
    private String time;
    private String subject;
    private String location;
    private String period;

    public ScheduleItem(String date, String time, String subject, String location, String period) {
        this.date = date;
        this.time = time;
        this.subject = subject;
        this.location = location;
        this.period = period;
    }

    // getters
    public String getDate() { return date; }
    public String getTime() { return time; }
    public String getSubject() { return subject; }
    public String getLocation() { return location; }
    public String getPeriod() { return period; }
}
