package com.example.teacher_scheduler.student;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import com.example.teacher_scheduler.R;
import java.util.ArrayList;
import java.util.List;

public class ScheduleFragment extends Fragment {
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_student_schedule, container, false);
        RecyclerView rv = root.findViewById(R.id.recyclerSchedule);
        rv.setLayoutManager(new LinearLayoutManager(getContext()));

        // Dữ liệu mẫu — thay bằng dữ liệu thật từ DB hoặc API
        List<ScheduleItem> list = new ArrayList<>();
        list.add(new ScheduleItem("Thứ ba , Ngày 15 / 10 / 2025", "07:00", "Tên môn học (Mã lớp)", "Đc Lớp", "Tiết : "));
        list.add(new ScheduleItem("Thứ tư , Ngày 16 / 10 / 2025", "07:00", "Tên môn học (Mã lớp)", "Đc Lớp", "Tiết : "));
        list.add(new ScheduleItem("Thứ bảy , Ngày 19 / 10 / 2025", "12:55", "Tên môn học (Mã lớp)", "Đc Lớp", "Tiết : "));
        // ... thêm item nếu cần

        ScheduleAdapter adapter = new ScheduleAdapter(list);
        rv.setAdapter(adapter);

        return root;
    }
}
