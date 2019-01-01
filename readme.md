# Limit Heartbeat

Limits the Heartbeat API in WordPress to certain areas of the site (and a longer pulse interval) to reduce AJAX queries and improve resource usage.

* [Plugin Homepage (LittleBizzy.com)](https://www.littlebizzy.com/plugins/limit-heartbeat)
* [Free Facebook Group](https://www.facebook.com/groups/littlebizzy/)

### Defined Constants

    /* Plugin Meta */
    define('DISABLE_NAG_NOTICES', true);
    
    /* Limit Heartbeat Functions */
    define('LIMIT_HEARTBEAT_DISABLE_DASHBOARD', false);
    define('LIMIT_HEARTBEAT_DISABLE_EDITOR', false);
    define('LIMIT_HEARTBEAT_DISABLE_FRONTEND', true);
    define('LIMIT_HEARTBEAT_INTERVAL_DASHBOARD', 600);
    define('LIMIT_HEARTBEAT_INTERVAL_EDITOR', 30);
    define('LIMIT_HEARTBEAT_INTERVAL_FRONTEND', 300);

### Support Issues

*Please do not submit Pull Requests. Instead, kindly create a new Issue with relevant information if you are an experienced developer, otherwise post your comments in our free Facebook group.*

***No emails, please! Thank you.***
