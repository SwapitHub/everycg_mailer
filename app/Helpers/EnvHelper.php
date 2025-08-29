<?php
if (!function_exists('setEnvValue')) {
    function setEnvValue(array $values)
    {
        $envFile = base_path('.env');
        $str = file_get_contents($envFile);

        foreach ($values as $envKey => $envValue) {
            $envValue = trim($envValue);

            if (strpos($str, "{$envKey}=") !== false) {
                // Replace existing line without quotes
                $str = preg_replace(
                    "/^{$envKey}=.*/m",
                    "{$envKey}={$envValue}",
                    $str
                );
            } else {
                // Append at end if not exists
                $str .= "\n{$envKey}={$envValue}";
            }
        }

        file_put_contents($envFile, $str);
    }
}
