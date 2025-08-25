    package com.example.teacher_scheduler.teacher.fragments;

    import android.app.DatePickerDialog;
    import android.os.Bundle;
    import android.widget.ArrayAdapter;
    import android.widget.AutoCompleteTextView;
    import android.widget.Button;

    import androidx.annotation.NonNull;
    import androidx.annotation.Nullable;
    import androidx.fragment.app.Fragment;
    import androidx.recyclerview.widget.LinearLayoutManager;
    import androidx.recyclerview.widget.RecyclerView;

    import android.view.LayoutInflater;
    import android.view.View;
    import android.view.ViewGroup;

    import com.example.teacher_scheduler.R;
    import com.example.teacher_scheduler.teacher.model.WeeklyContent;
    import com.google.android.material.textfield.TextInputEditText;

    import java.util.ArrayList;
    import java.util.Calendar;
    import java.util.List;

    public class TeacherCreateScheduleFragment extends Fragment {

        private TextInputEditText etStartDate, etEndDate;
        private AutoCompleteTextView actvCourse, actvClass, actvDayOfWeek, actvPeriod, actvRoom;
        private Button btnAddWeek, btnSaveSchedule;
        private RecyclerView rvWeeklyContent;
        private WeeklyContentAdapter weeklyContentAdapter;
        private List<WeeklyContent> weeklyContentList;

        private String[] courses = {"Cơ sở dữ liệu nâng cao", "Lập trình Android", "Mạng máy tính"};
        private String[] classes = {"CNTT16.01", "CNTT16.02", "CNTT16.03"};
        private String[] daysOfWeek = {"Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"};
        private String[] periods = {"Tiết 1-3", "Tiết 4-6", "Tiết 7-9", "Tiết 10-12"};
        private String[] rooms = {"A1.201", "A1.202", "A2.101", "A2.102"};

        public TeacherCreateScheduleFragment() {}

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            return inflater.inflate(R.layout.fragment_teacher_create_schedule, container, false);
        }

        @Override
        public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
            super.onViewCreated(view, savedInstanceState);
            actvCourse = view.findViewById(R.id.actvCourse);
            actvClass = view.findViewById(R.id.actvClass);
            actvDayOfWeek = view.findViewById(R.id.actvDayOfWeek);
            actvPeriod = view.findViewById(R.id.actvPeriod);
            actvRoom = view.findViewById(R.id.actvRoom);

            etStartDate = view.findViewById(R.id.etStartDate);
            etEndDate = view.findViewById(R.id.etEndDate);

            btnAddWeek = view.findViewById(R.id.btnAddWeek);
            btnSaveSchedule = view.findViewById(R.id.btnSaveSchedule);
            rvWeeklyContent = view.findViewById(R.id.rvWeeklyContent);

            // Dropdowns
            actvCourse.setAdapter(new ArrayAdapter<>(requireContext(), android.R.layout.simple_dropdown_item_1line, courses));
            actvClass.setAdapter(new ArrayAdapter<>(requireContext(), android.R.layout.simple_dropdown_item_1line, classes));
            actvDayOfWeek.setAdapter(new ArrayAdapter<>(requireContext(), android.R.layout.simple_dropdown_item_1line, daysOfWeek));
            actvPeriod.setAdapter(new ArrayAdapter<>(requireContext(), android.R.layout.simple_dropdown_item_1line, periods));
            actvRoom.setAdapter(new ArrayAdapter<>(requireContext(), android.R.layout.simple_dropdown_item_1line, rooms));

            // Date picker
            etStartDate.setOnClickListener(v -> showDatePicker(etStartDate));
            etEndDate.setOnClickListener(v -> showDatePicker(etEndDate));

            // RecyclerView
            weeklyContentList = new ArrayList<>();
            weeklyContentAdapter = new WeeklyContentAdapter(weeklyContentList);
            rvWeeklyContent.setLayoutManager(new LinearLayoutManager(getContext()));
            rvWeeklyContent.setAdapter(weeklyContentAdapter);

            // Buttons
            btnAddWeek.setOnClickListener(v -> {
                int weekNumber = weeklyContentList.size() + 1;
                weeklyContentList.add(new WeeklyContent(weekNumber, ""));
                weeklyContentAdapter.notifyItemInserted(weeklyContentList.size() - 1);
            });

            btnSaveSchedule.setOnClickListener(v -> {
                if (validateForm()) saveSchedule();
            });
        }

        private void showDatePicker(TextInputEditText dateField) {
            Calendar c = Calendar.getInstance();
            new DatePickerDialog(requireContext(), (view, y, m, d) ->
                    dateField.setText(d + "/" + (m + 1) + "/" + y),
                    c.get(Calendar.YEAR), c.get(Calendar.MONTH), c.get(Calendar.DAY_OF_MONTH)).show();
        }

        private boolean validateForm() {
            boolean isValid = true;
            if (actvCourse.getText().toString().trim().isEmpty()) { actvCourse.setError("Chọn môn"); isValid=false; }
            if (actvClass.getText().toString().trim().isEmpty()) { actvClass.setError("Chọn lớp"); isValid=false; }
            if (etStartDate.getText().toString().trim().isEmpty()) { etStartDate.setError("Chọn ngày bắt đầu"); isValid=false; }
            if (etEndDate.getText().toString().trim().isEmpty()) { etEndDate.setError("Chọn ngày kết thúc"); isValid=false; }
            if (actvDayOfWeek.getText().toString().trim().isEmpty()) { actvDayOfWeek.setError("Chọn thứ"); isValid=false; }
            if (actvPeriod.getText().toString().trim().isEmpty()) { actvPeriod.setError("Chọn tiết"); isValid=false; }
            if (actvRoom.getText().toString().trim().isEmpty()) { actvRoom.setError("Chọn phòng"); isValid=false; }
            if (weeklyContentList.isEmpty()) { showMessage("Thêm ít nhất 1 tuần"); isValid=false; }
            return isValid;
        }

        private void saveSchedule() { showMessage("Đã lưu"); clearForm(); }
        private void clearForm() {
            actvCourse.setText(""); actvClass.setText(""); actvDayOfWeek.setText(""); actvPeriod.setText(""); actvRoom.setText("");
            etStartDate.setText(""); etEndDate.setText("");
            weeklyContentList.clear(); weeklyContentAdapter.notifyDataSetChanged();
        }
        private void showMessage(String msg) { /*Toast.makeText(requireContext(), msg, Toast.LENGTH_SHORT).show();*/ }

        // Recycler Adapter
        private class WeeklyContentAdapter extends RecyclerView.Adapter<WeeklyContentAdapter.ViewHolder> {
            private final List<WeeklyContent> weeklyContents;
            WeeklyContentAdapter(List<WeeklyContent> list){ weeklyContents=list; }
            @NonNull @Override public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
                View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_weekly_content,parent,false);
                return new ViewHolder(v);
            }
            @Override public void onBindViewHolder(@NonNull ViewHolder holder, int position){ holder.bind(weeklyContents.get(position)); }
            @Override public int getItemCount(){ return weeklyContents.size(); }

            class ViewHolder extends RecyclerView.ViewHolder {
                com.google.android.material.textfield.TextInputEditText etWeekContent;
                ViewHolder(@NonNull View itemView){ super(itemView); etWeekContent = itemView.findViewById(R.id.etWeekContent); }
                void bind(WeeklyContent wc){
                    etWeekContent.setHint("Nội dung tuần "+wc.getWeekNumber());
                    etWeekContent.setText(wc.getContent());
                    etWeekContent.setOnFocusChangeListener((v,hasFocus)->{ if(!hasFocus) wc.setContent(etWeekContent.getText().toString()); });
                }
            }
        }
    }
