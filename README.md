
# Solution

Start docker: `./start.sh`

Project contains following:
- Approval Module `app/Modules/Approval`
- Invoices Module `app/Modules/Invoices`
- Shared Domain `app/Domain`
- Shared Infrastructure `app/Infrastructure`

it exposes following endpoints:
- `GET /api/invoices/{number}` - retrieve invoice data
- `POST /api/approval` - update state of entity into approved or rejected

example approval request body:
```json
{
    "id": "c150446d-2b74-4600-ba25-6b428a5305fe",
    "status": "approved",
    "entity": "App\\Modules\\Invoices\\Domain\\Entity\\Invoice"
}
```

TODO:
 - better dto validation (maybe some pre-events)
 - error handling (better exceptions, some standard error output for Exception Listener)
 - error logger
 - tests coverage (currently none)
 - query/response cache'ing ?
 - api docs
 - domain events?
