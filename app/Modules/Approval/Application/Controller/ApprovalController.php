<?php

declare(strict_types=1);

namespace App\Modules\Approval\Application\Controller;

use App\Domain\Enums\StatusEnum;
use App\Infrastructure\Controller;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ApprovalController extends Controller
{
    public function __construct(
        private readonly ApprovalFacadeInterface $approvalFacade,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = Uuid::fromString($request->get('id'));
        $status = StatusEnum::tryFrom($request->get('status'));
        $entity = $request->get('entity');

        $dto = new ApprovalDto($id, $status, $entity);

        if (StatusEnum::APPROVED === $status) {
            $this->approvalFacade->approve($dto);
        } elseif (StatusEnum::REJECTED === $status) {
            $this->approvalFacade->reject($dto);
        } else {
            return response()->json(['status' => 'error', 'error' => 'invalid status']);
        }

        return response()->json(['status' => $status]);
    }
}
