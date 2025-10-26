<?php
/**
 * Stripe Price ID Mapping
 * Maps service identifiers to their Stripe Price IDs
 * 
 * Note: These are the products created via the import script.
 * The order page has different services, so we use price_data for flexibility.
 * If you want to use pre-created Price IDs, update order.html services to match these.
 */

// One-Time Payment Price IDs (from actual products import)
define('PRICE_STRATEGIC_PLANNING_BASIC', 'price_1SKSoHFJO3XvllUN6BQm6AcL'); // $2,500
define('PRICE_STRATEGIC_PLANNING_ADVANCED', 'price_1SKSoIFJO3XvllUNMkGzpPvA'); // $5,000
define('PRICE_VISION_MISSION_WORKSHOP', 'price_1SKSoIFJO3XvllUNfih5bl6h'); // $1,500
define('PRICE_GOAL_SETTING_SESSION', 'price_1SKSoIFJO3XvllUN7Ya3vEdP'); // $1,200
define('PRICE_TEAM_RETREAT_HALF_DAY', 'price_1SKSoJFJO3XvllUNkcbkNteO'); // $2,000
define('PRICE_TEAM_RETREAT_FULL_DAY', 'price_1SKSoJFJO3XvllUNLyP6d8Jn'); // $3,500
define('PRICE_LEADERSHIP_TEAM_BUILDING', 'price_1SKSoJFJO3XvllUN3ET4Ud46'); // $4,500
define('PRICE_CONFLICT_RESOLUTION_WORKSHOP', 'price_1SKSoKFJO3XvllUNNjdwbMSu'); // $1,800
define('PRICE_LEADERSHIP_DEVELOPMENT_TRAINING', 'price_1SKSoKFJO3XvllUNYppSjQiK'); // $3,000
define('PRICE_COMMUNICATION_SKILLS_TRAINING', 'price_1SKSoLFJO3XvllUNWtbvmFvJ'); // $2,200
define('PRICE_CHANGE_MANAGEMENT_TRAINING', 'price_1SKSoLFJO3XvllUNyhUK6W2H'); // $2,800
define('PRICE_PROJECT_MANAGEMENT_TRAINING', 'price_1SKSoMFJO3XvllUNFvkwnc8B'); // $2,500
define('PRICE_CUSTOMER_SERVICE_TRAINING', 'price_1SKSoMFJO3XvllUNiPCLdTrE'); // $1,800
define('PRICE_DIGITAL_READINESS_ASSESSMENT', 'price_1SKSoMFJO3XvllUNcbdnrW3N'); // $1,500
define('PRICE_SOFTWARE_IMPLEMENTATION_SUPPORT', 'price_1SKSoNFJO3XvllUNarLMOi8Q'); // $4,000
define('PRICE_USER_TRAINING_PROGRAM', 'price_1SKSoNFJO3XvllUNsRoqIS6v'); // $2,500
define('PRICE_DIGITAL_CHANGE_MANAGEMENT', 'price_1SKSoNFJO3XvllUNS7xzvIxq'); // $3,200
define('PRICE_DIGITAL_WORKFLOW_OPTIMIZATION', 'price_1SKSoOFJO3XvllUNSKcEzddX'); // $2,800

// Recurring Subscription Price IDs (already in config.php)
// MONTHLY_PLAN_ID: price_1SKQiHFJO3XvllUNBIM4tENE ($29/month)
// YEARLY_PLAN_ID: price_1SKQiIFJO3XvllUNL6gd0zJl ($299/year)
// CONSULTING_MONTHLY_PLAN_ID: price_1SKQiIFJO3XvllUNa53Q7x4R ($2,000/month)
// CONSULTING_YEARLY_PLAN_ID: price_1SKQiIFJO3XvllUN2KGLIyAi ($20,000/year)

/**
 * Service to Price ID Mapping Array
 * Updated with correct Price IDs from actual products import
 */
$STRIPE_PRICE_MAP = [
    // Strategic Planning Services
    'strategic_planning_basic' => 'price_1SKSoHFJO3XvllUN6BQm6AcL', // $2,500
    'strategic_planning_advanced' => 'price_1SKSoIFJO3XvllUNMkGzpPvA', // $5,000
    
    // Workshop Services
    'vision_mission_workshop' => 'price_1SKSoIFJO3XvllUNfih5bl6h', // $1,500
    'goal_setting_session' => 'price_1SKSoIFJO3XvllUN7Ya3vEdP', // $1,200
    'conflict_resolution_workshop' => 'price_1SKSoKFJO3XvllUNNjdwbMSu', // $1,800
    
    // Team Services
    'team_retreat_half_day' => 'price_1SKSoJFJO3XvllUNkcbkNteO', // $2,000
    'team_retreat_full_day' => 'price_1SKSoJFJO3XvllUNLyP6d8Jn', // $3,500
    'leadership_team_building' => 'price_1SKSoJFJO3XvllUN3ET4Ud46', // $4,500
    
    // Training Services
    'leadership_development_training' => 'price_1SKSoKFJO3XvllUNYppSjQiK', // $3,000
    'communication_skills_training' => 'price_1SKSoLFJO3XvllUNWtbvmFvJ', // $2,200
    'change_management_training' => 'price_1SKSoLFJO3XvllUNyhUK6W2H', // $2,800
    'project_management_training' => 'price_1SKSoMFJO3XvllUNFvkwnc8B', // $2,500
    'customer_service_training' => 'price_1SKSoMFJO3XvllUNiPCLdTrE', // $1,800
    
    // Digital Services
    'digital_readiness_assessment' => 'price_1SKSoMFJO3XvllUNcbdnrW3N', // $1,500
    'software_implementation_support' => 'price_1SKSoNFJO3XvllUNarLMOi8Q', // $4,000
    'user_training_program' => 'price_1SKSoNFJO3XvllUNsRoqIS6v', // $2,500
    'digital_change_management' => 'price_1SKSoNFJO3XvllUNS7xzvIxq', // $3,200
    'digital_workflow_optimization' => 'price_1SKSoOFJO3XvllUNSKcEzddX', // $2,800
];

/**
 * Get Price ID for a service
 * Returns the Stripe Price ID if one exists for this service, null otherwise
 */
function getStripePriceId($serviceValue) {
    global $STRIPE_PRICE_MAP;
    return isset($STRIPE_PRICE_MAP[$serviceValue]) ? $STRIPE_PRICE_MAP[$serviceValue] : null;
}

/**
 * Check if service should use pre-created Price ID or price_data
 */
function usePreCreatedPrice($serviceValue) {
    return getStripePriceId($serviceValue) !== null;
}
?>

