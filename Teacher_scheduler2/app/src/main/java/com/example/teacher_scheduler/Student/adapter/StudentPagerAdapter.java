package com.example.teacher_scheduler.Student.adapter;



import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.viewpager2.adapter.FragmentStateAdapter;

public class StudentPagerAdapter extends FragmentStateAdapter {

    public StudentPagerAdapter(@NonNull FragmentActivity fragmentActivity) {
        super(fragmentActivity);
    }

    @NonNull
    @Override
    public Fragment createFragment(int position) {
        return new ScheduleFragment(); // có thể tái dùng fragment cũ
    }

    @Override
    public int getItemCount() {
        return 3; // 3 tab
    }
}
