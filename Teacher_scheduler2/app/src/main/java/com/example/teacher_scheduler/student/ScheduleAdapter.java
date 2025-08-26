package com.example.teacher_scheduler.student;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import com.example.teacher_scheduler.R;
import java.util.List;

public class ScheduleAdapter extends RecyclerView.Adapter<ScheduleAdapter.VH> {
    private final List<ScheduleItem> items;

    public ScheduleAdapter(List<ScheduleItem> items) { this.items = items; }

    @NonNull
    @Override
    public VH onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_schedule_student

, parent, false);
        return new VH(v);
    }

    @Override
    public void onBindViewHolder(@NonNull VH holder, int position) {
        ScheduleItem s = items.get(position);
        holder.tvDate.setText(s.dateLabel);
        holder.tvTime.setText(s.time);
        holder.tvTitle.setText(s.title);
        holder.tvLocation.setText("📍 " + s.location);
        holder.tvPeriods.setText("[ " + s.periods + " ]");
    }

    @Override
    public int getItemCount() { return items.size(); }

    static class VH extends RecyclerView.ViewHolder {
        TextView tvDate, tvTime, tvTitle, tvLocation, tvPeriods;
        VH(@NonNull View v) {
            super(v);
            tvDate = v.findViewById(R.id.tvDateChip);
            tvTime = v.findViewById(R.id.tvTime);
            tvTitle = v.findViewById(R.id.tvTitle);
            tvLocation = v.findViewById(R.id.tvLocation);
            tvPeriods = v.findViewById(R.id.tvPeriods);
        }
    }
}
