import styles from "./Projects.module.css";
import Image from "next/image";
import { cards } from "@/entities/projects/model/card.data";

export const ColumnRight = () => {
  return (
    <>
      <div className={styles.columnRight}>
        {cards.map(
          (card, i) =>
            i % 2 !== 0 && (
              <div key={card.cardBottomTitle} className={styles.card}>
                <div
                  className={styles.cardTop}
                  style={{ backgroundImage: `url(${card.bg})` }}
                >
                  {card.flag && (
                    <>
                      <div className={styles.raiting}>
                        <div className={styles.raitingImg}>
                          <Image
                            src="/awards/gold.svg"
                            alt="gold"
                            width={29}
                            height={28}
                          />
                        </div>
                        <div className={styles.raitingText}>
                          Рейтинг рунета. Кейс года
                        </div>
                      </div>
                      <div className={styles.link}>
                        <Image
                          src="/projects/whiteArrow.svg"
                          alt="whiteArrow"
                          width={24}
                          height={24}
                        />
                      </div>
                    </>
                  )}
                  {card.achievement && (
                    <>
                      <div className={styles.achievements}>
                        <div className={styles.achievement}>
                          <Image
                            src={card.achievement}
                            alt="achievement"
                            width={29}
                            height={28}
                          />
                        </div>
                        <div className={styles.achievement}>
                          <Image
                            src={card.achievement}
                            alt="achievement"
                            width={29}
                            height={28}
                          />
                        </div>
                      </div>
                    </>
                  )}
                </div>

                <div className={styles.cardBottom}>
                  <div className={styles.cardBottomTitle}>
                    {card.cardBottomTitle}
                  </div>
                  <div className={styles.cardBottomSubtitle}>
                    {card.cardBottomSubtitle}
                  </div>
                </div>
              </div>
            ),
        )}
      </div>
    </>
  );
};
