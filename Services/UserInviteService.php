<?php

namespace OIDCIntegration\Services;

use OIDCIntegration\Notifications\UserInviteNotification;
use OIDCIntegration\Users\Models\User;

class UserInviteService extends UserTokenService
{
    protected string $tokenTable = 'user_invites';
    protected int $expiryTime = 336; // Two weeks

    /**
     * Send an invitation to a user to sign into OIDCIntegration
     * Removes existing invitation tokens.
     */
    public function sendInvitation(User $user)
    {
        $this->deleteByUser($user);
        $token = $this->createTokenForUser($user);
        $user->notify(new UserInviteNotification($token));
    }
}
