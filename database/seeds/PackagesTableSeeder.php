<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('packages')->delete();

        \DB::table('packages')->insert([
            0 => [
                'id'          => 1,
                'name'        => 'Basic',
                'limits'      => '{"api": false, "mms": false, "reply": 1, "users": 2, "groups": 15, "keywords": 1, "monthly_sms": 500, "custom_labels": 10, "group_contacts": 30, "long_messaging": false, "auto_reply_date": false, "message_templates": 10, "auto_reply_weekdays": false, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '29.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            1 => [
                'id'          => 2,
                'name'        => 'Small Business',
                'limits'      => '{"api": false, "mms": true, "reply": 2, "users": 5, "groups": 10, "keywords": 2, "monthly_mms": "100", "monthly_sms": 5000, "custom_labels": 5, "group_contacts": 50, "long_messaging": true, "auto_reply_date": true, "message_templates": 50, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '100.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            2 => [
                'id'          => 3,
                'name'        => 'Enterprise',
                'limits'      => '{"api": true, "mms": true, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_mms": "100", "monthly_sms": 50000, "custom_labels": 10, "group_contacts": 50, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            3 => [
                'id'          => 4,
                'name'        => 'Enterprise_nomms',
                'limits'      => '{"api": true, "mms": false, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_sms": 50000, "custom_labels": 10, "group_contacts": 50, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            4 => [
                'id'          => 5,
                'name'        => 'Enterprise_trial',
                'limits'      => '{"api": false, "mms": true, "reply": 3, "users": 15, "groups": 15, "keywords": 1, "monthly_mms": "40", "monthly_sms": 200, "custom_labels": 10, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": true, "chat_message_templates": true}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            5 => [
                'id'          => 6,
                'name'        => 'Enterprise_trial_nomms',
                'limits'      => '{"api": false, "mms": false, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_sms": 200, "custom_labels": 10, "group_contacts": 50, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            6 => [
                'id'          => 7,
                'name'        => 'Enterprise_carl',
                'limits'      => '{"api": true, "mms": false, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_sms": 3000, "custom_labels": 10, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            7 => [
                'id'          => 8,
                'name'        => 'Enterprise_sms5000',
                'limits'      => '{"api": false, "mms": true, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_mms": "100", "monthly_sms": 5000, "custom_labels": 10, "group_contacts": 50, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
            8 => [
                'id'          => 9,
                'name'        => 'API',
                'limits'      => '{"api": true, "mms": true, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_mms": 5000, "monthly_sms": 5000, "custom_labels": 10, "group_contacts": 50, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '300.00',
                'created_at'  => '2018-02-03 00:27:10',
                'updated_at'  => '2018-02-03 00:27:16',
            ],
            9 => [
                'id'          => 10,
                'name'        => 'Enterprise_small',
                'limits'      => '{"api": true, "mms": false, "reply": 3, "users": 15, "groups": 15, "keywords": 3, "monthly_sms": 60, "custom_labels": 10, "long_messaging": true, "auto_reply_date": true, "message_templates": 100, "auto_reply_weekdays": true, "conversation_resize": "false", "conversations_limit": 1, "ar_message_templates": false, "chat_message_templates": false}',
                'monthly_fee' => '195.00',
                'created_at'  => '2017-09-07 16:34:09',
                'updated_at'  => '2017-09-07 16:34:09',
            ],
        ]);


    }
}