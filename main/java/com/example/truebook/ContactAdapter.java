package com.example.truebook;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.*;

import java.util.ArrayList;

public class ContactAdapter extends BaseAdapter {

    Context context;
    ArrayList<ContactModel> contactList;
    LayoutInflater inflater;

    public ContactAdapter(Context context, ArrayList<ContactModel> contactList) {
        this.context = context;
        this.contactList = contactList;
        this.inflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return contactList.size();
    }

    @Override
    public Object getItem(int position) {
        return contactList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    static class ViewHolder {
        TextView name, number;
        Button callBtn, smsBtn;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        ViewHolder holder;
        final ContactModel contact = contactList.get(position);

        if (convertView == null) {
            convertView = inflater.inflate(R.layout.contact_item, parent, false);
            holder = new ViewHolder();
            holder.name = convertView.findViewById(R.id.contactName);
            holder.number = convertView.findViewById(R.id.contactNumber);
            holder.callBtn = convertView.findViewById(R.id.btnCall);
            holder.smsBtn = convertView.findViewById(R.id.btnSms);
            convertView.setTag(holder);
        } else {
            holder = (ViewHolder) convertView.getTag();
        }

        holder.name.setText(contact.name);
        holder.number.setText(contact.number);

        holder.callBtn.setOnClickListener(v -> {
            Intent callIntent = new Intent(Intent.ACTION_DIAL, Uri.parse("tel:" + contact.number));
            context.startActivity(callIntent);
        });

        holder.smsBtn.setOnClickListener(v -> {
            Intent smsIntent = new Intent(Intent.ACTION_SENDTO, Uri.parse("smsto:" + contact.number));
            smsIntent.putExtra("sms_body", "Salut les Zéros !");
            context.startActivity(smsIntent);
        });

        return convertView;
    }
}
