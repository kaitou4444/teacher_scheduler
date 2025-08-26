package com.example.teacher_scheduler.student;

public class ScheduleItem {
    public String dateLabel; // ví dụ "Thứ ba , Ngày 15 / 10 / 2025"
    public String time;      // "07:00"
    public String title;     // "Tên môn học (Mã lớp)"
    public String location;  // "Đc Lớp"
    public String periods;   // "Tiết : "

    public ScheduleItem(String dateLabel, String time, String title, String location, String periods) {
        this.dateLabel = dateLabel;
        this.time = time;
        this.title = title;
        this.location = location;
        this.periods = periods;
    }
}
