package com.example.teacher_scheduler.teacher.activities;

import android.os.Bundle;
import android.widget.Toolbar;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.viewpager2.adapter.FragmentStateAdapter;
import androidx.viewpager2.widget.ViewPager2;

import com.example.teacher_scheduler.R;
import com.example.teacher_scheduler.teacher.fragments.TeacherCreateScheduleFragment;
import com.example.teacher_scheduler.teacher.fragments.TeacherMakeupScheduleFragment;
import com.example.teacher_scheduler.teacher.fragments.TeacherScheduleListFragment;
import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;

public class TeacherScheduleActivity extends AppCompatActivity {

    private ViewPager2 viewPager;
    private TabLayout tabLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_teacher_schedule);

        // Thiết lập Toolbar
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        // Thiết lập ViewPager và TabLayout
        viewPager = findViewById(R.id.viewPager);
        tabLayout = findViewById(R.id.tabLayout);

        // Tạo adapter cho ViewPager
        SchedulePagerAdapter adapter = new SchedulePagerAdapter(this);
        viewPager.setAdapter(adapter);

        // Kết nối TabLayout với ViewPager
        new TabLayoutMediator(tabLayout, viewPager,
                (tab, position) -> {
                    switch (position) {
                        case 0:
                            tab.setText("Tạo lịch");
                            tab.setIcon(R.drawable.ic_create);
                            break;
                        case 1:
                            tab.setText("Danh sách");
                            tab.setIcon(R.drawable.ic_list);
                            break;
                        case 2:
                            tab.setText("Dạy bù");
                            tab.setIcon(R.drawable.ic_makeup);
                            break;
                    }
                }
        ).attach();
    }

    // Adapter cho ViewPager
    private class SchedulePagerAdapter extends FragmentStateAdapter {

        public SchedulePagerAdapter(FragmentActivity fa) {
            super(fa);
        }

        @Override
        public Fragment createFragment(int position) {
            switch (position) {
                case 0:
                    return new TeacherCreateScheduleFragment();
                case 1:
                    return new TeacherScheduleListFragment();
                case 2:
                    return new TeacherMakeupScheduleFragment();
                default:
                    return null;
            }
        }

        @Override
        public int getItemCount() {
            return 3;
        }
    }

    @Override
    public boolean onSupportNavigateUp() {
        onBackPressed();
        return true;
    }
}