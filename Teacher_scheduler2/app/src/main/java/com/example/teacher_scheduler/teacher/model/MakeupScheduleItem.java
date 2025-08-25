package com.example.teacher_scheduler.teacher.model;

public class MakeupScheduleItem {
    private String courseName;
    private String originalDate;
    private String makeupDate;
    private String time;
    private String room;
    private String className;
    private String reason;

    public MakeupScheduleItem(String courseName, String originalDate, String makeupDate,
                              String time, String room, String className, String reason) {
        this.courseName = courseName;
        this.originalDate = originalDate;
        this.makeupDate = makeupDate;
        this.time = time;
        this.room = room;
        this.className = className;
        this.reason = reason;
    }

    // Getter methods
    public String getCourseName() { return courseName; }
    public String getOriginalDate() { return originalDate; }
    public String getMakeupDate() { return makeupDate; }
    public String getTime() { return time; }
    public String getRoom() { return room; }
    public String getClassName() { return className; }
    public String getReason() { return reason; }
}
