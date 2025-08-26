package com.example.teacher_scheduler.Student.activity;
import com.example.teacher_scheduler.Student.adapter.StudentPagerAdapter;



import android.os.Bundle;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.viewpager2.widget.ViewPager2;

import com.example.teacher_scheduler.R;
import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;

public class StudentActivity extends AppCompatActivity {

    TabLayout tabLayoutStudent;
    ViewPager2 viewPagerStudent;
    StudentPagerAdapter adapter;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_student);

        tabLayoutStudent = findViewById(R.id.tabLayoutStudent);
        viewPagerStudent = findViewById(R.id.viewPagerStudent);

        adapter = new StudentPagerAdapter(this);
        viewPagerStudent.setAdapter(adapter);

        new TabLayoutMediator(tabLayoutStudent, viewPagerStudent,
                (tab, position) -> {
                    switch (position) {
                        case 0: tab.setText("Hôm nay"); break;
                        case 1: tab.setText("Lịch học"); break;
                        case 2: tab.setText("Tải lịch"); break;
                    }
                }).attach();
    }
}
