package com.example.teacher_scheduler.teacher.fragments;

import android.app.DatePickerDialog;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;

import com.example.teacher_scheduler.R;
import com.example.teacher_scheduler.teacher.model.WeeklyContent;
import com.google.android.material.textfield.TextInputEditText;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link TeacherCreateScheduleFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class TeacherCreateScheduleFragment extends Fragment {

    // Form fields
    private TextInputEditText etStartDate, etEndDate;
    private EditText actvCourse, actvClass, actvDayOfWeek, actvPeriod, actvRoom;
    private Button btnAddWeek, btnSaveSchedule;

    // RecyclerView for weekly content
    private RecyclerView rvWeeklyContent;
    private WeeklyContentAdapter weeklyContentAdapter;
    private List<WeeklyContent> weeklyContentList;

    // Dropdown data (in real app, this would come from API/database)
    private String[] courses = {"Cơ sở dữ liệu nâng cao", "Lập trình Android", "Mạng máy tính"};
    private String[] classes = {"CNTT16.01", "CNTT16.02", "CNTT16.03"};
    private String[] daysOfWeek = {"Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"};
    private String[] periods = {"Tiết 1-3", "Tiết 4-6", "Tiết 7-9", "Tiết 10-12"};
    private String[] rooms = {"A1.201", "A1.202", "A2.101", "A2.102"};

    public TeacherCreateScheduleFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_teacher_create_schedule, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        // Initialize views
        initViews(view);

        // Setup dropdowns
        setupDropdowns();

        // Setup date pickers
        setupDatePickers();

        // Setup RecyclerView
        setupRecyclerView();

        // Setup button listeners
        setupButtonListeners();
    }

    private void initViews(View view) {
        actvCourse = view.findViewById(R.id.actvCourse);
        actvClass = view.findViewById(R.id.actvClass);
        etStartDate = view.findViewById(R.id.etStartDate);
        etEndDate = view.findViewById(R.id.etEndDate);
        actvDayOfWeek = view.findViewById(R.id.actvDayOfWeek);
        actvPeriod = view.findViewById(R.id.actvPeriod);
        actvRoom = view.findViewById(R.id.actvRoom);
        rvWeeklyContent = view.findViewById(R.id.rvWeeklyContent);
        btnAddWeek = view.findViewById(R.id.btnAddWeek);
        btnSaveSchedule = view.findViewById(R.id.btnSaveSchedule);
    }

    private void setupDropdowns() {
        // Course dropdown
        ArrayAdapter<String> courseAdapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                courses
        );
        actvCourse.setAdapter(courseAdapter);

        // Class dropdown
        ArrayAdapter<String> classAdapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                classes
        );
        actvClass.setAdapter(classAdapter);

        // Day of week dropdown
        ArrayAdapter<String> dayAdapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                daysOfWeek
        );
        actvDayOfWeek.setAdapter(dayAdapter);

        // Period dropdown
        ArrayAdapter<String> periodAdapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                periods
        );
        actvPeriod.setAdapter(periodAdapter);

        // Room dropdown
        ArrayAdapter<String> roomAdapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                rooms
        );
        actvRoom.setAdapter(roomAdapter);
    }

    private void setupDatePickers() {
        // Start date picker
        etStartDate.setOnClickListener(v -> showDatePicker(etStartDate));

        // End date picker
        etEndDate.setOnClickListener(v -> showDatePicker(etEndDate));
    }

    private void showDatePicker(TextInputEditText dateField) {
        final Calendar calendar = Calendar.getInstance();
        int year = calendar.get(Calendar.YEAR);
        int month = calendar.get(Calendar.MONTH);
        int day = calendar.get(Calendar.DAY_OF_MONTH);

        DatePickerDialog datePickerDialog = new DatePickerDialog(
                requireContext(),
                (view, selectedYear, selectedMonth, selectedDay) -> {
                    String selectedDate = selectedDay + "/" + (selectedMonth + 1) + "/" + selectedYear;
                    dateField.setText(selectedDate);
                },
                year, month, day
        );

        datePickerDialog.show();
    }

    private void setupRecyclerView() {
        weeklyContentList = new ArrayList<>();
        weeklyContentAdapter = new WeeklyContentAdapter(weeklyContentList);

        rvWeeklyContent.setLayoutManager(new LinearLayoutManager(getContext()));
        rvWeeklyContent.setAdapter(weeklyContentAdapter);
    }

    private void setupButtonListeners() {
        // Add week button
        btnAddWeek.setOnClickListener(v -> {
            int weekNumber = weeklyContentList.size() + 1;
            WeeklyContent newWeek = new WeeklyContent(weekNumber, "");
            weeklyContentList.add(newWeek);
            weeklyContentAdapter.notifyItemInserted(weeklyContentList.size() - 1);
        });

        // Save schedule button
        btnSaveSchedule.setOnClickListener(v -> {
            if (validateForm()) {
                saveSchedule();
            }
        });
    }

    private boolean validateForm() {
        boolean isValid = true;

        if (actvCourse.getText().toString().trim().isEmpty()) {
            actvCourse.setError("Vui lòng chọn môn học");
            isValid = false;
        }

        if (actvClass.getText().toString().trim().isEmpty()) {
            actvClass.setError("Vui lòng chọn lớp học phần");
            isValid = false;
        }

        if (etStartDate.getText().toString().trim().isEmpty()) {
            etStartDate.setError("Vui lòng chọn ngày bắt đầu");
            isValid = false;
        }

        if (etEndDate.getText().toString().trim().isEmpty()) {
            etEndDate.setError("Vui lòng chọn ngày kết thúc");
            isValid = false;
        }

        if (actvDayOfWeek.getText().toString().trim().isEmpty()) {
            actvDayOfWeek.setError("Vui lòng chọn thứ trong tuần");
            isValid = false;
        }

        if (actvPeriod.getText().toString().trim().isEmpty()) {
            actvPeriod.setError("Vui lòng chọn tiết học");
            isValid = false;
        }

        if (actvRoom.getText().toString().trim().isEmpty()) {
            actvRoom.setError("Vui lòng chọn phòng học");
            isValid = false;
        }

        if (weeklyContentList.isEmpty()) {
            // Show error message
            showMessage("Vui lòng thêm nội dung cho ít nhất một tuần");
            isValid = false;
        }

        return isValid;
    }

    private void saveSchedule() {
        // Get form data
        String course = actvCourse.getText().toString();
        String classSection = actvClass.getText().toString();
        String startDate = etStartDate.getText().toString();
        String endDate = etEndDate.getText().toString();
        String dayOfWeek = actvDayOfWeek.getText().toString();
        String period = actvPeriod.getText().toString();
        String room = actvRoom.getText().toString();

        // Here you would typically send this data to your API
        // For now, we'll just show a success message
        showMessage("Đã lưu lịch giảng dạy thành công");

        // Clear form after successful submission
        clearForm();
    }

    private void clearForm() {
        actvCourse.setText("");
        actvClass.setText("");
        etStartDate.setText("");
        etEndDate.setText("");
        actvDayOfWeek.setText("");
        actvPeriod.setText("");
        actvRoom.setText("");

        weeklyContentList.clear();
        weeklyContentAdapter.notifyDataSetChanged();
    }

    private void showMessage(String message) {
        // You can use Toast or Snackbar here
        // For example:
        // Toast.makeText(requireContext(), message, Toast.LENGTH_SHORT).show();
    }

    // Adapter for weekly content
    private class WeeklyContentAdapter extends RecyclerView.Adapter<WeeklyContentAdapter.ViewHolder> {

        private List<WeeklyContent> weeklyContents;

        public WeeklyContentAdapter(List<WeeklyContent> weeklyContents) {
            this.weeklyContents = weeklyContents;
        }

        @NonNull
        @Override
        public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
            View view = LayoutInflater.from(parent.getContext())
                    .inflate(R.layout.item_weekly_content, parent, false);
            return new ViewHolder(view);
        }

        @Override
        public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
            WeeklyContent weeklyContent = weeklyContents.get(position);
            holder.bind(weeklyContent);
        }

        @Override
        public int getItemCount() {
            return weeklyContents.size();
        }

        public class ViewHolder extends RecyclerView.ViewHolder {
            private TextInputEditText etWeekContent;

            public ViewHolder(@NonNull View itemView) {
                super(itemView);
                etWeekContent = itemView.findViewById(R.id.etWeekContent);
            }

            public void bind(WeeklyContent weeklyContent) {
                etWeekContent.setHint("Nội dung tuần " + weeklyContent.getWeekNumber());
                etWeekContent.setText(weeklyContent.getContent());

                // Save content when text changes
                etWeekContent.setOnFocusChangeListener((v, hasFocus) -> {
                    if (!hasFocus) {
                        weeklyContent.setContent(etWeekContent.getText().toString());
                    }
                });
            }
        }
    }
}