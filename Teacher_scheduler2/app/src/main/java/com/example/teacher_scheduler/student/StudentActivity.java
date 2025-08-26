package com.example.teacher_scheduler.student;

import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.viewpager2.widget.ViewPager2;
import com.example.teacher_scheduler.R;
import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;

public class StudentActivity extends AppCompatActivity {
    private TabLayout tabLayout;
    private ViewPager2 viewPager;
    private final String[] tabTitles = new String[] { "Hôm nay", "Lịch học", "Tải lịch" };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_student);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        // nếu muốn title nằm giữa, bạn có thể chỉnh trong layout toolbar
        getSupportActionBar().setTitle("TLU Schedule");

        viewPager = findViewById(R.id.viewPager);
        viewPager.setAdapter(new StudentPagerAdapter(this));

        tabLayout = findViewById(R.id.tabLayout);
        new TabLayoutMediator(tabLayout, viewPager,
                (tab, position) -> tab.setText(tabTitles[position])
        ).attach();
    }
}
