"use client";

import Image from "next/image";
import styles from "./Reviews.module.scss";
import { document } from "@/shared/assets/images/reviews";
import { ReviewsResource } from "@/entities/trustUs/api/types";

import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

interface ReviewsProps {
  reviews: ReviewsResource[];
}

export const Reviews = ({ reviews }: ReviewsProps) => {
  if (!reviews || reviews.length === 0) {
    return <div className={styles.reviews}>Нет отзывов</div>;
  }

  return (
    <section className={styles.reviewsWrapper}>
      <Swiper
        modules={[Navigation, Pagination, Autoplay]}
        spaceBetween={0}
        slidesPerView={3}
        pagination={{ clickable: true }}
        autoplay={{ delay: 4000, disableOnInteraction: false }}
        loop={reviews.length > 1}
        className={styles.swiper}
      >
        {reviews.map((review) => {
          const avatarUrl = review.image?.original_url || null;
          return (
            <SwiperSlide key={review.id}>
              <div className={styles.review}>
                <div className={styles.top}>
                  <div className={styles.title}>{review.project?.title || "Отзыв"}</div>
                  <div className={styles.button}>
                    <Image
                      src={document}
                      alt="Документ"
                      width={24}
                      height={24}
                      className={styles.img}
                    />
                  </div>
                </div>

                <div className={styles.content}>
                  <div className={styles.text}>{review.content}</div>
                  <div className={styles.autor}>
                    <div className={styles.avatar}>
                      {avatarUrl ? (
                        <Image
                          src={avatarUrl}
                          alt={review.fio || "Аватар"}
                          width={48}
                          height={48}
                          className={styles.avatarImage}
                          unoptimized
                        />
                      ) : (
                        <div className={styles.avatarPlaceholder}>
                          {review.fio?.charAt(0) || "А"}
                        </div>
                      )}
                    </div>

                    <div className={styles.info}>
                      <div className={styles.name}>{review.fio}</div>
                      <div className={styles.position}>{review.position}</div>
                    </div>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          );
        })}
      </Swiper>
    </section>
  );
};
