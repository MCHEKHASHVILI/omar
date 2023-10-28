<?php

namespace App\Repositories\SubscriptionRepository\Interfaces;

interface SubscriptionRepositoryInterface
{
    /**
     * Get Subscription Benefits whatever they are
     */
    public function subscribe();
    /**
     * Unsubscribe from active plan
     * do any neccessary jobs whatewer thay are
     */
    public function unsubscribe();

}


/**
 *
 * Subscription logic
 *
 * @fields: valid_till, count, shown
 * @normal: just 3 videos, for unlimited time, free (hidden)
 * @premium: unlimited views for one month, 12$
 *
 * Requirements:
 * after watching 3 videos user is directed to profile page with the notification about asking for subscription
 * ocne subscribtion timed out the notifycation comes again.
 *
 */
