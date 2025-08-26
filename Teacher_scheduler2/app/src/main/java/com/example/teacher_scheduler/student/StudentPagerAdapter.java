package com.example.teacher_scheduler.student;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.viewpager2.adapter.FragmentStateAdapter;

public class StudentPagerAdapter extends FragmentStateAdapter {
    public StudentPagerAdapter(@NonNull FragmentActivity fa) {
        super(fa);
    }

    @NonNull
    @Override
    public Fragment createFragment(int position) {
        switch (position) {
            case 0: return new TodayFragment();
            case 1: return new ScheduleFragment();
            default: return new ExportFragment();
        }
    }

    @Override
    public int getItemCount() { return 3; }
}
