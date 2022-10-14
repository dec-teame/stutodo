import '@fullcalendar/core/vdom'; // for Vite
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";

var calendar;
let calendarEl = document.getElementById("calendar");

// Cannot read property '__k' of nullエラーを避けるため
// 下のif文を追加。calendarElがnullでなけらばif文の中実行。
if (calendarEl != null) {
    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "",
        },
    });
    calendar.render();
}