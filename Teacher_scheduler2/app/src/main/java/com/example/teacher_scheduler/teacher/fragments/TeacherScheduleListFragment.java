package com.example.teacher_scheduler.teacher.fragments;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.example.teacher_scheduler.R;

import java.util.ArrayList;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link TeacherScheduleListFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class TeacherScheduleListFragment extends Fragment {

        private RecyclerView recyclerView;
        private ScheduleAdapter adapter;

        public TeacherScheduleListFragment() {
            // Required empty public constructor
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            return inflater.inflate(R.layout.fragment_teacher_schedule_list, container, false);
        }

        @Override
        public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
            super.onViewCreated(view, savedInstanceState);

            recyclerView = view.findViewById(R.id.rvSchedules);
            Button btnFilter = view.findViewById(R.id.btnFilter);

            // Thiết lập RecyclerView
            recyclerView.setLayoutManager(new LinearLayoutManager(getContext()));

            // Lấy dữ liệu lịch giảng dạy (trong thực tế sẽ lấy từ API)
            List<ScheduleItem> schedules = getSchedules();
            adapter = new ScheduleAdapter(schedules);
            recyclerView.setAdapter(adapter);

            // Xử lý sự kiện lọc
            btnFilter.setOnClickListener(v -> {
                // Xử lý lọc dữ liệu
            });
        }

        private List<ScheduleItem> getSchedules() {
            // Dữ liệu mẫu, trong thực tế sẽ lấy từ API
            List<ScheduleItem> schedules = new ArrayList<>();

            schedules.add(new ScheduleItem(
                    "Cơ sở dữ liệu nâng cao",
                    "Thứ 2, 10/04/2023",
                    "07:30 - 10:00",
                    "Phòng A1.201",
                    "Lớp CNTT16.01"
            ));

            schedules.add(new ScheduleItem(
                    "Lập trình Android",
                    "Thứ 3, 11/04/2023",
                    "13:30 - 16:00",
                    "Phòng A2.105",
                    "Lớp CNTT16.02"
            ));

            return schedules;
        }

        // Adapter cho RecyclerView
        private class ScheduleAdapter extends RecyclerView.Adapter<ScheduleAdapter.ViewHolder> {

            private List<ScheduleItem> schedules;

            public ScheduleAdapter(List<ScheduleItem> schedules) {
                this.schedules = schedules;
            }

            @NonNull
            @Override
            public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
                View view = LayoutInflater.from(parent.getContext())
                        .inflate(R.layout.item_schedule, parent, false);
                return new ViewHolder(view);
            }

            @Override
            public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
                ScheduleItem item = schedules.get(position);
                holder.bind(item);
            }

            @Override
            public int getItemCount() {
                return schedules.size();
            }

            public class ViewHolder extends RecyclerView.ViewHolder {
                private TextView tvCourseName, tvDate, tvTime, tvRoom, tvClass;

                public ViewHolder(@NonNull View itemView) {
                    super(itemView);
                    tvCourseName = itemView.findViewById(R.id.tvCourseName);
                    tvDate = itemView.findViewById(R.id.tvDate);
                    tvTime = itemView.findViewById(R.id.tvTime);
                    tvRoom = itemView.findViewById(R.id.tvRoom);
                    tvClass = itemView.findViewById(R.id.tvClass);
                }

                public void bind(ScheduleItem item) {
                    tvCourseName.setText(item.getCourseName());
                    tvDate.setText(item.getDate());
                    tvTime.setText(item.getTime());
                    tvRoom.setText(item.getRoom());
                    tvClass.setText(item.getClassName());
                }
            }
        }

}