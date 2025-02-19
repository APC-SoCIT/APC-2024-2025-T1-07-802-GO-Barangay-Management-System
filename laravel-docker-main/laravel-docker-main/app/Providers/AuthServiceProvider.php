use Illuminate\Auth\Notifications\VerifyEmail;
// ...existing code...

public function boot()
{
    $this->registerPolicies();

    // ...existing code...

    VerifyEmail::toMailUsing(function ($notifiable, $url) {
        return (new MailMessage)
            ->subject('Verify Email Address')
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email Address', $url);
    });
}
