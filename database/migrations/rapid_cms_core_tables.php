<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        /**
         * Settings table and seeder
         */
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('option');
            $table->text('value')->nullable();
            $table->timestamps();
        });
        $this->seedSettings();

        /**
         * Mail Templates table and seeder
         */
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('purpose')->nullable();
            $table->string('code')->unique();
            $table->longText('content');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('mail_templates');
    }

    private function seedSettings(): void
    {
        $settings = [
            'app_name' => 'AdminR',
            'app_tagline' => 'Generate CRUDs within minutes.',
            'meta_title' => 'AdminR - Simple yet powerful admin panel crud generator.',
            'meta_description' => 'A simple yet powerful Admin panel with a CRUD generator built on laravel to help you build applications faster.',
            'title_separator' => '-',
            'queueable_email' => '1',
            'should_verify_email' => '1',
        ];

        foreach ($settings as $option => $value) {
            DB::table('settings')->insert([
                'option' => $option,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedMailTemplates(): void
    {
        $mailTemplates = [
            [
                'subject' => 'Welcome to {app.name}.',
                'purpose' => 'To be sent when user registers and verification is disabled.',
                'code' => 'registration-welcome-mail',
                'content' => '## Welcome to {app.name}

You are successfully registered with us,
please login to start using our platform.

### Registered account details

Name: {name} {br}
Username: {username} {br}
Email: **{email}** {br}
Password: `your selected password` {br}',
            ],
            [
                'subject' => 'Welcome to {app.name}.',
                'purpose' => 'To be sent when user registers and verification is enabled.',
                'code' => 'registration-email-verification-mail',
                'content' => '## Welcome to {app.name} Please verify your email: {email}

You are successfully registered with us please verify your email
to continue using our platform.

### Registered account details

Name: {name} {br}
Username: {username} {br}
Email: **{email}** {br}
Password: `your selected password` {br}

Verification Link: [Verify now]({verify_link}) {br}

Or

You can click below link to verify your account.
<{verify_link}>',
            ],
            [
                'subject' => 'Welcome to {app.name}.',
                'purpose' => 'To be sent when user registers and verification is enabled with OTP method typically it will be for api auth.',
                'code' => 'registration-email-verification-with-otp-mail',
                'content' => '## Welcome to {app.name} Please verify your email: {email}

You are successfully registered with us please verify your email
to continue using our platform.

### Registered account details

Name: {name} {br}
Username: {username} {br}
Email: **{email}** {br}
Password: `your selected password` {br}

Verification Code: **{otp}**

Enter above **OTP** in the verification screen and verify your account.

',
            ],
            [
                'subject' => 'Verify your email.',
                'purpose' => 'To be sent when user request for email verification manually.',
                'code' => 'email-verification-mail',
                'content' => '## Verify your email: {email}

We received a verification request for the account associated with
email- **{email}** please click the link below to verify your account.

Verification Link: [Verify now]({verify_link}) {br}

Or

You can click below link to verify your account.
<{verify_link}>

### If this was not you who requested the verification please ignore this mail.

',
            ],
            [
                'subject' => 'Verify your email.',
                'purpose' => 'To be sent when user request for email verification manually with OTP method.',
                'code' => 'email-verification-otp-mail',
                'content' => '## Verify your email: {email}

We received a verification request for the account associated with
email- **{email}** please use verification given below to verify your account.

Verification Code: **{otp}**

### If this was not you who requested the verification please ignore this mail.

',
            ],
            [
                'subject' => 'Email verified successfully.',
                'purpose' => 'To be sent when email verification completed successfully.',
                'code' => 'email-verification-success-mail',
                'content' => '## Email verified successfully

Congratulations your account verified successfully
now you can login and use our platform.

[Login Now]({login_link})

',
            ],
            [
                'subject' => 'Your password updated successfully for {email}!',
                'purpose' => 'To be sent when password updated.',
                'code' => 'password-updated-mail',
                'content' => '## Password updated successfully

Congratulations! Your password has been reset successfully for your account
associated with email **{email}** now you can login to your account.

[Login Now]({login_link})

',
            ],
        ];

        foreach ($mailTemplates as $mailTemplate) {
            DB::table('mail_templates')->insert([
                'subject' => $mailTemplate['subject'],
                'purpose' => $mailTemplate['purpose'],
                'code' => $mailTemplate['code'],
                'content' => $mailTemplate['content'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
