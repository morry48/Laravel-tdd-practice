<h1>{{ $lesson->name }}</h1>
<div>
  <span>空き状況: {{ $lesson->vacancyLevel }}</span>
    <div>
    @if($lesson->vacancyLevel->mark() === '◎' || $lesson->vacancyLevel->mark() === '△')
        <button class="btn btn-primary">このレッスンを予約する</button>
    @else
        <span class="btn btn-primary disabled">予約できません</span>
    @endif
    </div>
</div>

